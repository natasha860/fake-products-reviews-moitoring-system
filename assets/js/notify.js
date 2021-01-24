type = ['primary', 'info', 'success', 'warning', 'danger'];
code = {
    showNotification: function (from, align, msg, iconText, color) {
        //color = Math.floor((Math.random() * 4) + 1);
        if (iconText == '') {
          iconText = 'notifications';
        }

        $.notify({
            icon: iconText,
            message: msg,

          }, {
            type: type[color],
            timer: 1000,
            placement: {
                from: from,
                align: align,
              },
          });
      },
  };
