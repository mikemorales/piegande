export const getFormData = (formId) => {
    const _form = document.getElementById(formId);
    return new FormData(_form);
}
