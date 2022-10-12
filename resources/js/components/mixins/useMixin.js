import {ref} from 'vue'
import sweetAlert from 'sweetalert2';

export const useMixin = () => {
    const progress = ref(false);
    const onUploadProgress = (p) => {
        progress.value = Math.round((p.loaded * 100) / p.total);
        console.log(progress);
    };
    const showAlert = (kindAlert, title, msg) => {

        sweetAlert.fire({
            title: title, text: msg, icon: kindAlert
        }).then(function () {

        })
    };
    const validarEmail = (email) => {
        let expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!expr.test(email))
            // alert("Error: La dirección de correo " + email + " es incorrecta.");
            return false;
    };
    const valFormularios = (form = null) => {
        let _action = true;
        let _nameField = '';
        let inputs = '';

        if (form !== null) {
            const _form = document.querySelector('.' + form);
            inputs = _form.getElementsByClassName('required');
        } else {
            inputs = document.getElementsByClassName('required');
        }

        let convertToArray = Array.from(inputs);

        for (let i = 0; i < convertToArray.length; i++) {
            let item = convertToArray[i];
            if (item.classList.contains('required')) {
                if (item.getAttribute('type')) {
                    switch (item.getAttribute('type')) {
                        case 'hidden':
                        case 'text':
                        case 'tel':
                        case 'password':
                        case 'date':
                            if (item.value === undefined || item.value === '' || item.value === '0' || item.value.length === 0) {
                                _nameField = item.getAttribute('placeholder');
                                _action = false;
                            }
                            break;
                        case 'number':
                            if (item.value === undefined || item.value === '') {
                                _nameField = item.getAttribute('placeholder');
                                _action = false;
                            }
                            break;
                        case 'email':
                            if (item.value === undefined || item.value === '' || item.value === '0' || item.value.length === 0) {
                                _nameField = item.getAttribute('placeholder');
                                _action = false;
                            } else {
                                if (validarEmail(item.value) === false) {
                                    _nameField = item.getAttribute('placeholder');
                                    _action = false;
                                }
                            }
                            break;
                        case 'radio':
                        case 'checkbox':
                            if (item.checked === false) {
                                _nameField = item.getAttribute('placeholder');
                                _action = false;
                            }
                            break;
                        case 'file':
                            console.log(item.files.length);
                            if (item.files.length === 0) {
                                _nameField = item.dataset.nameInput;
                                _action = false;
                            }
                            break;
                    }
                } else {
                    if (item.dataset.select === 'on' || item.dataset.textarea === 'on') {
                        if (item.value === undefined || item.value === '' || item.value === '0' || item.value === "-1") {
                            _nameField = item.dataset.nameInput;
                            _action = false;
                            break;
                        }
                    }
                }

            }//END IF CLASS REQUIRED
            if (_action === false) {
                break;
            }
        }//END FOR

        if (_action === true) {
            return true;
        } else {
            // console.log('Recogiendo el valor _nameField = ' + _nameField);
            return showAlert('error', 'Falta información', _nameField);

        }

    };
    const getAlert = (getResponse) => {
        let _msg = '';
        let _kindAlert = '';
        let _title = '';
        switch (getResponse) {

            case 'not_found':
                _msg = 'Al parecer no existe la abreviación de esta ciudad.';
                _kindAlert = 'warning';
                _title = '¡Ups!';
                break;
            case 'deleted':
                _msg = 'El registro se elimino correctamente.';
                _kindAlert = 'success';
                _title = '¡Eliminado!';
                break;
            case 'registered':
                _msg = 'El registro ya existe, intenta con uno diferente.';
                _kindAlert = 'warning';
                _title = 'Falta información';
                break;
            case 'fail':
                _msg = 'Algo Salio mal, intenta de nuevo.';
                _kindAlert = 'error';
                _title = 'Falta información';
                break;
            case 'error_picture':
                _msg = 'Algo Salio mal, la imagen puede que el formato se incorrecto o la imagen es muy pesada.';
                _kindAlert = 'error';
                _title = 'Falta información';
                break;
            case 'updated':
                _msg = 'El registro se actualizó correctamente';
                _kindAlert = 'success';
                _title = '¡En hora buena!';
                break;
            case 'success':
                _msg = 'El registro se guardo correctamente.';
                _kindAlert = 'success';
                _title = '¡En hora buena!';
                break;
        }

        showAlert(_kindAlert, _title, _msg);

    };
    const stateId = ($e) => {
        let state_id;
        if (typeof $e === 'object') {
            state_id = $e.target.options[$e.target.options.selectedIndex].value;
        } else {
            state_id = $e;
        }
        return state_id;
    };
    const goBack = () => {
        window.history.back();
    }
    const getNameFile = (event, field) => {
        let _fileData = event.target.files[0];
        let _ContainerFileName = document.querySelector('.' + field);
        _ContainerFileName.textContent = _fileData.name;
    }
    return {
        progress,
        onUploadProgress,
        showAlert,
        validarEmail,
        valFormularios,
        getAlert,
        stateId,
        goBack,
        getNameFile
    }
}
