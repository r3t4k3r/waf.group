<div class="mt-4 container mb-4">
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
                <a>Мои услуги</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Серверы</li>
            </ol>
        </nav>
    <div class="row mt-3 goods">
        <h1>Мои услуги</h1>
    </div>
</div>
<div class="container mt-4">
    <div>
        <button class="btn btn-primary" href="/order/vps">Создать новый виртуальный сервер</button>
    </div>
</div>

<div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="modal-password"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card p-3 p-lg-4">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" id="cl-p" aria-label="Close"
                        onClick="controlReset()"></button>
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h4">Смена пароля<br>у <b id="info-_hip"></b></h1>
                    </div>

                    <div class="form-group mb-3">
                        <p>Внимание! Пароль не будет сохранен в нашей панели управления, Вам придётся его запомнить.
                            Если Вы вдруг забудите пароль, Вы можете его заново восстановить на данной странице.</p>
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" class="form-control" placeholder="Минимум 8 символов" id="c-pass">
                        <small class="mt-2 d-block" style="cursor: pointer;" onClick="rand()">Сгенерировать
                            пароль</small>
                    </div>

                    <div class="form-group">
                        <center><button class="btn btn-info" onClick="changePass(this)">Изменить пароль</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-reinstall" tabindex="-1" role="dialog" aria-labelledby="modal-password"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card p-3 p-lg-4">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" id="cl-s" aria-label="Close"
                        onClick="controlReset()"></button>
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h4">Переустановка системы<br>у <b id="info-_sip"></b></h1>
                    </div>

                    <div class="form-group mb-3">
                        <p>Внимание! Все данные при переустановке удаляются.</p>
                    </div>

                    <div class="form-group mb-4">
                        <h6>Операционная система: <b id="tariffos">Не выбрано</b></h6>

                        <div class="oslist"></div>
                    </div>

                    <div class="form-group">
                        <center><button class="btn btn-info" onClick="reinstalSystem(this)">Переустановить
                                систему</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-control" tabindex="-1" role="dialog" aria-labelledby="modal-control"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card p-3 p-lg-4">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h4">Управление <b id="info-hip"></b></h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-12 mb-3">
                            <button class="btn btn-primary w-100" onClick="reboot(this)">Перезапустить</button>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12 mb-3">
                            <button class="btn btn-primary w-100" onClick="reinstall(this)">Переустановить</button>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12 mb-3">
                            <button class="btn btn-primary w-100" onClick="pay(this)">Продлить сервер</button>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12 mb-3">
                            <button class="btn btn-primary w-100" onClick="password(this)">Сменить пароль</button>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="form-group mb-3">
                            <label for="">IP-адрес</label>
                            <input type="text" class="form-control" value="" id="info-ip" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Пользователь</label>
                            <input type="text" class="form-control" value="" id="info-user" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Пароль*</label>
                            <input type="text" class="form-control" value="" id="info-password" readonly>
                        </div>
                        <a>* Пароль верный только на момент установки, после его смены мы не сохраняем его в панели управления. Если Вы вдруг забудите пароль, Вы можете его заново восстановить здесь же.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
clearTimeout(window.timer);

function generatePassword() {
    var length = 14,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}

function rand() {
    $('#c-pass').val(generatePassword())
}

function password(core) {
    $('.modal').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('hide')

    $('#modal-password').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('show')

    $('#info-_hip').html(window._ip)
}

function selectOs(core) {
    $('.os').removeClass('active')
    $(core).addClass('active')
    $('#tariffos').html(core.innerHTML)
}

function reinstall(core) {
    $('.modal').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('hide')

    $('#modal-reinstall').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('show')
}

function controlReset() {
    $('.modal').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('hide')

    $('#modal-control').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('show')

    $('#c-pass').val('')
}

function control(id, core) {
    $('.loader').fadeIn()

    query('/api/vps.get/', {
        type: 'POST',
        data: {
            id: id
        }
    }).then((response) => {
        $('#info-_sip').html(response.success['vps.ip'])
        $('#info-hip').html(response.success['vps.ip'])
        $('#info-ip').val(response.success['vps.ip'])
        $('#info-user').val(response.success['vps.user'])
        $('#info-password').val(response.success['vps.password'])

        window._control = id
        window._ip = response.success['vps.ip']
        window._handler = response.success['q']

        $('.loader').fadeOut()

        setTimeout(() => {
            $('#modal-control').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show')
        }, 300);

        query('/api/ostempl.get/', {
            type: 'POST',
            data: {
                q: window._handler
            }
        }).then((os) => {
            $('.oslist').html('')
            os.success.forEach((system) => {
                let response = `<span class="os" onClick="selectOs(this)">` + system[
                    'os.name'] + `</span>`
                $('.oslist').append(response)
            })
        })
    })

    return true;
}

function changePass(core) {
    if ($(core).hasClass('text-white')) return

    $(core).removeClass('btn-danger').addClass('btn-info')
    spinner(core)

    query('/api/vps.password/', {
        type: 'POST',
        data: {
            id: window._control,
            password: $('#c-pass').val()
        }
    }).then((e) => {
        spinner(core)

        if (e.type == 'success') {
            $(core).html('Пароль изменен').addClass(
                    'btn-success').removeClass('btn-danger').removeClass('confirm')
                .addClass('text-white').addClass('btn-success')

            window.timer = setTimeout(() => {
                $(core).html('Сменить пароль').removeClass('btn-danger').removeClass('confirm')
                    .removeClass('btn-success').removeClass('text-white')
                $('#c-pass').val('')
                document.querySelector('#cl-p').click()
            }, 5000)
        } else {
            $(core).html('Пароль слишком мал').removeClass('btn-danger').removeClass('confirm').removeClass(
                'btn-success').removeClass('text-white').addClass('btn-danger')

            window.timer = setTimeout(() => {
                $(core).html('Сменить пароль').removeClass('btn-danger')
            }, 1500);
        }
    })
}

function reinstalSystem(core) {
    if ($(core).hasClass('text-white')) return

    $(core).removeClass('btn-danger').addClass('btn-info')
    spinner(core)

    query('/api/vps.reinstall/', {
        type: 'POST',
        data: {
            id: window._control,
            os: $('#tariffos').html()
        }
    }).then((e) => {
        spinner(core)

        $(core).html('Переустановка началась')
            .removeClass('btn-danger').removeClass('confirm')
            .addClass('text-white').addClass('btn-success').removeClass('btn-info')

        window.timer = setTimeout(() => {
            $(core).html('Переустановить систему').removeClass('btn-danger').removeClass('confirm')
                .removeClass('btn-success').removeClass('text-white').addClass('btn-info')
            $('#tariffos').html('Не выбрано')
            $('.os').removeClass('active')
            document.querySelector('#cl-s').click()
        }, 5000)
    })
}

function reboot(core) {
    if ($(core).hasClass('text-white')) return

    clearTimeout(window.timer)

    if (!$(core).hasClass('confirm')) {
        $(core).html('Нажмите ещё раз для перезагрузки').addClass('btn-danger').addClass('confirm')

        window.timer = setTimeout(() => {
            $(core).html('Перезапустить сервер').removeClass('btn-danger').removeClass('confirm').removeClass(
                'btn-success').removeClass('text-white')
        }, 5000)
    } else {
        $(core).removeClass('btn-danger').addClass('btn-info')
        spinner(core)

        query('/api/vps.reboot/', {
            type: 'POST',
            data: {
                id: window._control
            }
        }).then(() => {
            spinner(core)

            $(core).html('Перезагрузка началась').addClass(
                    'btn-success').removeClass('btn-danger').removeClass('confirm')
                .addClass('text-white').removeClass('btn-info')

            window.timer = setTimeout(() => {
                $(core).html('Перезапустить сервер').removeClass('btn-danger').removeClass('confirm')
                    .removeClass('btn-success').removeClass('text-white').removeClass('btn-info')
            }, 5000)
        })
    }
}

function pay(core) {
    if ($(core).hasClass('text-white')) return

    clearTimeout(window.timer)

    if (!$(core).hasClass('confirm')) {
        $(core).html('Нажмите ещё раз для продления').addClass('btn-danger').addClass('confirm')

        window.timer = setTimeout(() => {
            $(core).html('Продлить сервер').removeClass('btn-danger').removeClass('confirm').removeClass(
                'btn-success').removeClass('text-white')
        }, 5000)
    } else {
        $(core).removeClass('btn-danger').addClass('btn-info')
        spinner(core)

        query('/api/vps.pay/', {
            type: 'POST',
            data: {
                id: window._control
            }
        }).then((e) => {
            spinner(core)

            if (e.type == 'success') {
                $(core).html('Сервер продлен.').addClass(
                        'btn-success').removeClass('btn-danger').removeClass('confirm')
                    .addClass('text-white').removeClass('btn-info')

                window.timer = setTimeout(() => {
                    $(core).html('Продлить сервер').removeClass('btn-danger').removeClass('confirm')
                        .removeClass('btn-success').removeClass('text-white').removeClass('btn-info')
                }, 5000)
            } else {
                $(core).html(e.error).addClass(
                        'btn-danger').removeClass('btn-danger').removeClass('confirm')
                    .addClass('text-white').removeClass('btn-info')

                window.timer = setTimeout(() => {
                    $(core).html('Продлить сервер').removeClass('btn-danger').removeClass('confirm')
                        .removeClass('btn-success').removeClass('text-white').removeClass('btn-info')
                        .removeClass('btn-danger')
                }, 5000)
            }
        })
    }
}

query('/api/vps.list/').then((goods) => {
    goods.success.forEach((good) => {
        let response = `<div class="col-lg-6 col-sm-6 col-xs-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <h2 class="h6 text-gray-400 mb-0">VM #` + good['vmmgr.id'] + ` [ <b class="` + ((good.status ==
            0 || good.status == -1) ? "text-warning" : (good.status == 1 ? "text-success" :
            "text-danger")) + `">` + (good.status == -1 ? "ожидает оплаты" : (good.status == 0 ?
            "установка" : (good.status == 1 ? "активен" : (good.status == 2 ? "заблокирован" :
                "неизвестно")))) + `</b> ]</h2>
                        <h3 class="fw-extrabold">` + (good['vps.ip'] != "0" ? good['vps.ip'] : "Установка") + `</h3>
                        <span class="` + (good.status == 1 ? `mb-3 ` : ``) + `d-block">` + (good.status != 0 ?
            `Оплачен до: ` + good['date.end'] : ``) + `` + (good.status == 1 || good.status == -
            1 ?
            ` <br><span style="cursor: pointer;" onClick="control('` + good['id'] +
            `', this)">Продлить сервер за ` + good['price'] + ` RUB</span>` : ``) + `</span>
                        ` + (good.status == 1 ?
            `<button class="btn btn-primary w-100" onClick="control('` + good['id'] +
            `', this)">Открыть панель управления</button>` : ``) + `
                    </div>
                </div>
            </div>
        </div>`

        $('.goods').append(response)
    })

    $('.loader').fadeOut()
})
</script>