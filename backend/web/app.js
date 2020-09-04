$(function(){
    'use strict';

    $('#imageFile').change( ev => {
        $(ev.target).closest('form').trigger('submit');
    })
});