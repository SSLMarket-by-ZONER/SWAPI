$(function () {

    var $tabs = $('#tabs').tabs({
        activate: function (event, ui) {
            var active = $tabs
                    .tabs('option', 'active');

            $prev
                    .prop('disabled', active < 1)
                    .button("refresh");

            $next
                    .prop("disabled", active >= $tabspanel.size() - 1)
                    .button("refresh");
        }
    });

    var $tabspanel = $(".ui-tabs-panel");

    var $submit = $("#submit").button({
        icons: {
            primary: "ui-icon-mail-closed"
        },
        text: true
    }).click(function () {
        //submit form 
    });

    var $prev = $("#prev")
            .prop('disabled', true)
            .button({
                icons: {
                    primary: "ui-icon-arrowthick-1-w"
                },
                text: true
            })
            .click(function (event) {
                event.preventDefault();
                var active = $tabs
                        .tabs('option', 'active');
                $tabs
                        .tabs('option', 'active', active - 1)
                        .tabs("refresh");
            });

    var $next = $("#next")
            .button({
                icons: {
                    primary: "ui-icon-arrowthick-1-e"
                },
                text: true
            })
            .click(function (event) {
                event.preventDefault();
                var active = $tabs
                        .tabs('option', 'active');
                $tabs
                        .tabs('option', 'active', active + 1)
                        .tabs("refresh");
            });


    var $inputs = $("input[required='required']");

    $inputs.on("input change", function () {
        var ready = true;

        $inputs.each(function () {

            if ($(this).val().trim() == '') {
                ready = false;
                return false;
            }

            return true;
        });

        $submit
                .prop('disabled', !ready)
                .prop('title', ready ? 'Všechna povinná pole jsou vyplněna, objednávku můžete odeslat' : 'Nejsou vyplněna všechna povinná pole formuláře')
                .button("refresh");
    });


});


