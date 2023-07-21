<div class="container mt-4">
    <nav>
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a>
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                     </svg>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a>Финансы</a>
             </li>
            <li class="breadcrumb-item active" aria-current="page">Баланс и пополнение</li>
        </ol>
    </nav>
    <div class="row">
        <h1>Финансы<p></h1>
        <div class="col-12 col-xl-6">
            <div class="card card-body border-0 shadow mb-4">
                <h4>Текущий баланс</h4>
                <h1><font size="8"><div id="money">0 ₽</div></font></h1>
                <form>
                    <button class="btn btn-primary" onClick="pay('enot')">Пополнить баланс</button>
                </form>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card card-body border-0 shadow mb-4">
                <h4>Пополнений на сумму</h4>
                <h1><font size="8"><div id="deposits">0 ₽</div></font></h1>
                <form>
                    <button class="btn btn-primary" disabled>Детализация</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="modal-payment" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card p-3 p-lg-4">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" id="cl-s" aria-label="Close" onClick="controlReset()"></button>
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h4">Оплата</h1>
                    </div>
                    
                    <div class="col-12 col-md-4 col-xxl-12 mb-4">
                        <div class="card border-1 shadow">
                            <div class="card-body py-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-transparent border-bottom py-3 px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <a href="#" class="avatar-md">
                                                    <img class="rounded" alt="Image placeholder" src="https://sun9-25.userapi.com/impg/zpV2SmzLjh3nwd9UY7m1NdwNfuNgy_vP1kYEGw/cEvYm0HANTQ.jpg?size=1868x1868&quality=95&sign=ab994925f3dbe0806b5a229ef11d7042&type=album">
                                                </a>
                                            </div>
                                            <div class="col-auto px-0">
                                                <h4 class="fs-6 text-dark mb-0">
                                                    <a href="#">Пополнение баланса</a>
                                                </h4>
                                                <span class="small">Банк.карты, криптовалюта и т.п</span>
                                            </div>
                                            <div class="col text-end">
                                                <span class="fs-6 fw-bolder text-dark">(выбрано)</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <a>Укажите сумму платежа</a>
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" class="form-control" placeholder="Минимальная сумма: 10 ₽" id="num">
                    </div>

                    <div class="form-group">
                        <center><button class="btn btn-info" onClick="redirect(this)" id="asd" disabled>Оплатить</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function pay(method) {
        window.method = method

        $('#modal-payment').modal({
            backdrop: 'static',
            keyboard: false
        }).modal('show')
    }

    $('#num').on('input', () => {
        if($('#num').val() >= 10) {
            $('#asd').prop('disabled', false)
        } else $('#asd').prop('disabled', true)
    })

    function redirect() {
        location.href = "/api/payments.create?method=" + window.method + '&num=' + $('#num').val()
    }

    $(function() {
        query('/api/users.get/').then((user) => {
            $('#money').html(user.success.balance + ' ₽')
        })
        query('/api/users.get/').then((user) => {
            $('#deposits').html(user.success.deposits + ' ₽')
        })
    });
</script>