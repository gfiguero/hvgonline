    var optionsUnit = {
        enableClickableOptGroups: true,
        enableCollapsibleOptGroups: true,
        enableFiltering: true,
        buttonWidth: '100%',
        filterPlaceholder: 'Buscar',
        enableCaseInsensitiveFiltering: true,
        maxHeight: 400,
        disableIfEmpty: true
    };
    $('.multiselect_person').multiselect(optionsUnit);
    var optionsRut = {
        formatOn: 'keyup',
        minimumLength: 8,
        validateOn: 'change keyup'
    }
    $('.rut').rut(optionsRut);
