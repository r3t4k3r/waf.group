<?php
	// class VM {
		$host = 'https://sun.lco.pw/vm/v3';
		$email = 'site@wolutions.io';
		$vmpassword = 'lV5fT4yZ6szC';
		$vmadmin = 5;

		function restart($vmid) {
			global $host;
			global $email;
			global $vmpassword;

			$url = $host . '/host/' . $vmid . '/restart';
			$token = auth();

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "x-xsrf-token: " . $token,
			   "Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result, 1);

			return $response;
		}

		function auth() {
			global $host;
			global $email;
			global $vmpassword;

			$data = json_encode(array('email' => $email, 'password' => $vmpassword));
			$url = $host . '/public/auth';
			
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result, 1);

			return $response['token'];
		}

		function createVM($cluster, $node, $storage, $os, $ram, $rom, $cpu, $ip, $password) {
			global $host;
			global $email;
			global $vmpassword;
			global $vmadmin;

			$url = $host . '/host';
			$token = auth();

			$data = json_encode(array(
				"name" => "WaF",
				"cluster" => $cluster,
				"node" => $node,
				"storage" => $storage,
				"account" => $vmadmin,
				"domain" => time() . ".waf.group",
				"os" => (int)$os,
				"password" => $password,
				"ram_mib" => (int)$ram,
				"hdd_mib" => (int)$rom,
				"cpu_number" => (int)$cpu,
				"ip_addr" => array(
				    "name" => $ip
				)
			));

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "x-xsrf-token: " . $token,
			   "Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result, 1);

			return $response['id'] ?? json_encode($result);
		}

		function reinstall($id, $password, $os) {
			global $host;
			global $email;
			global $vmpassword;
			
			$url = $host . '/host/' . $id . '/reinstall';
			$token = auth();

			$data = json_encode(array(
				"os" => (int)$os,
				"password" => $password,
				"send_email_mode" => "default"
			));

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "x-xsrf-token: " . $token,
			   "Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result, 1);

			return $response['id'] ?? ($response['error'] ?? false);
		}

		function passwordV($id, $password) {
			global $host;
			global $email;
			global $vmpassword;
			
			$url = $host . '/host/' . $id . '/password';
			$token = auth();

			$data = json_encode(array(
				"password" => $password
			));

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "x-xsrf-token: " . $token,
			   "Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result, 1);

			return $response['id'] ?? ($response['error'] ?? false);
		}

		function stop($vmid) {
			global $host;
			global $email;
			global $vmpassword;
			
			$url = $host . '/host/' . $vmid . '/stop';
			$token = auth();

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "x-xsrf-token: " . $token,
			   "Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result, 1);

			return $response;
		}

		function start($vmid) {
			global $host;
			global $email;
			global $vmpassword;
			
			$url = $host . '/host/' . $vmid . '/start';
			$token = auth();

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "x-xsrf-token: " . $token,
			   "Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result, 1);

			return $response;
		}

		function drop($vmid) {
			global $host;
			global $email;
			global $vmpassword;
			
			$url = $host . '/host/' . $vmid;
			$token = auth();

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "x-xsrf-token: " . $token,
			   "Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result, 1);

			return $response;
		}
?>