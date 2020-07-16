import Vue from "vue";

export const alertService = {
    alertPhone,
};

const app = new Vue();

function alertPhone(current_phone = '') {
    console.log(app.$root);
    return app.$swal({
        icon: 'info',
        title: app.$i18n.t('app.phone.form.create.title'),
        html: app.$i18n.t('app.phone.form.create.text'),
        input: 'text',
        inputValue: '',
        inputAttributes: {
            name: 'phone',
        },
        showCancelButton: true,
        confirmButtonText: app.$i18n.t('app.phone.form.create.submit_value'),
        cancelButtonText: app.$i18n.t('app.phone.form.create.cancel_value'),
    });

}

function alertThankYou()
{
    return alert.$swal.fire({
        title: 'Thank you!'
    });
}
