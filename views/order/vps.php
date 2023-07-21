<div class="mt-4 container">
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
                <a>Заказать</a>
             </li>
            <li class="breadcrumb-item active" aria-current="page">Виртуальный сервер</li>
        </ol>
    </nav>
</div>

<div class="mt-4 container" id="groups"></div>

<div class="mt-4 container mb-4" id="tariffs"></div>

<div class="modal fade" id="modal-settings" tabindex="-1" role="dialog" aria-labelledby="modal-register"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card p-3 p-lg-4">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h4">Настройка тарифного плана<br><b id="tariffname"></b></h1>
                    </div>
                    <div class="form-group mb-4">
                        <h6>Операционная система: <b id="tariffos">Не выбрана</b></h6>

                        <div class="oslist"></div>
                    </div>
                    <div class="form-group">
                        <center><button class="btn btn-info" id="buy">Подтвердить покупку</button></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
clearTimeout(window.timer)

window.groups = []

$(document).on('click', '#buy', () => {
    spinner('#buy')
    $('[aria-label="Close"]').fadeOut(0)

    query('/api/vps.order/', {
        type: 'POST',
        data: {
            q: window.q,
            tariffname: window.tariffname,
            osname: $('#tariffos').html()
        }
    }).then((response) => {
        $('[aria-label="Close"]').fadeIn(0)
        if(response.type == 'error') {
            spinner('#buy')
            $('#buy').addClass('btn-danger').html(response.error)

            setTimeout(() => {
                $('#buy').removeClass('btn-danger').html('Подтвердить покупку')
            }, 2000);
        } else {
            spinner('#buy')
            $('#buy').addClass('btn-success').removeClass('btn-info').html(response.success).addClass('text-white')

            setTimeout(() => {
                $('#modal-settings').modal({
                    backdrop: 'static',
                    keyboard: false
                }).modal('hide')
                
                $('#buy').removeClass('btn-success').html('Подтвердить покупку')
                page('/index')
            }, 2000);
        }
    })
})

function selectOs(core) {
    $('.os').removeClass('active')
    $(core).addClass('active')
    $('#tariffos').html(core.innerHTML)
}

function startSettings(q, tariffname) {
    $('#modal-settings').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('show')

    $('#tariffname').html(tariffname)

    ostempl(q)

    window.q = q
    window.tariffname = tariffname
}

function ostempl(q) {
    $('.oslist').html('')
    query('/api/ostempl.get/', {
        type: 'POST',
        data: {
            q: q
        }
    }).then((os) => {
        os.success.forEach((system) => {
            let response = `<span class="os" onClick="selectOs(this)">` + system['os.name'] + `</span>`
            $('.oslist').append(response)
        })
    })
}

query('/api/tariffs.get/').then((tariffs) => {
    
    tariffs = JSON.parse(tariffs.success)
    
    tariffs.forEach((tariff) => {
        if(window.groups.indexOf(tariff.group) == -1) {
            window.groups.push(tariff.group)
        }
        
        let response = `<div class="card card-body mb-3 tariff" group="` + tariff.group + `">
                <div class="row">
                    <div class="col-lg-6">
                    <b>` + tariff['tariff.name'] + `</b><br>
                    ` + tariff['tariff.description'] + `
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex float-right align-items-center">
                            <b class="mr-4">` + tariff['tariff.price'] + ` RUB</b>
                            <button class="btn btn-info ml-4" onClick="startSettings('` + tariff[
            'q'] + `', '` + tariff['tariff.name'] + `')">Заказать</button>
                        </div>
                    </div>
                </div>
            </div>`

        $('#tariffs').append(response)
    })

    $('.loader').fadeOut()
}).then(() => {
    let index = 0
    window.groups.forEach((group) => {
        group = group.replace('🇷🇺', '&#127479;&#127482;')

        if(index == 0) {
            $('#groups').append(`<span onClick="setGroup(-1)">ВСЕ</span>`)
        }

        $('#groups').append(`<span onClick="setGroup(` + index + `)">` + group + `</span>`)

        index++
    })
})

function setGroup(value) {
    $('.tariff').fadeOut(0)
    
    if(value != -1) {
        $('[group="' + window.groups[value] + '"]').fadeIn(0)
    } else $('.tariff').fadeIn(0)
}
</script>