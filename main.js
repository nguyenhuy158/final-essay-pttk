function getFormData($form) {
    let source = $form.serializeArray();
    let result = {};

    $.map(source, function (value) {
        result[value['name']] = value['value'];
    });

    return result;
}
