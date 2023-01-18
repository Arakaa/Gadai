Vue.prototype.$GenerateInput = function (header) {
    var data = this;
    header = header || false;
    inputs = [];

    for (key in data) {
        if ($.isArray(data[key])) {
            this.$GenerateInputDetail(inputs, key, data[key]);

            continue;
        }

        if (header) {
            inputs.push({
                name: key,
                value: data[key]
            });
        }
    }

    return inputs;
};

Vue.prototype.$GenerateInputDetail = function (inputs) {
    for (arr in arrs) {
        var i = Object.keys(arrs).indexOf(arr);
        var objs = arrs[arr];

        for (obj in objs) {
            if ($.isArray(objs[obj])) {
                this.$GenerateInputDetail(inputs, obj, objs[obj]);

                continue;
            }

            inputs.push({
                name: key + '[' + i + '].' + obj,
                value: objs[obj]
            });
        }
    }
};

Vue.prototype.$http = axios;

Vue.prototype.$pnotify = function (desktopNotification = false, type = PNotifyAlertType.DEFAULT, title = '', text = '', onClick = null) {
    if (desktopNotification)
        PNotify.desktop.permission();

    let pnotify = {
        type: '',
        class: '',
        icon: ''
    };
    switch (type) {
        case PNotifyAlertType.DEFAULT:
            pnotify.class += 'bg-primary';
            break;
        case PNotifyAlertType.INFO:
            pnotify.type = 'info';
            pnotify.class += 'bg-info';
            break;
        case PNotifyAlertType.SUCCESS:
            pnotify.type = 'success';
            pnotify.class += 'bg-success';
            break;
        case PNotifyAlertType.WARNING:
            pnotify.type = 'warning';
            pnotify.class += 'bg-warning';
            break;
        case PNotifyAlertType.DANGER:
            pnotify.type = 'danger';
            pnotify.class += 'bg-danger';
            break;
    }

    var _notification = new PNotify({
        title: desktopNotification ? title : '<b>' + title + '</b>',
        type: pnotify.type,
        text: text,
        addclass: pnotify.class,
        desktop: {
            desktop: desktopNotification ? true : false,
        }
    });

    _notification.get().click(function (e) {
        _notification.remove();
        if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
        if (onClick)
            onClick();
    })
};