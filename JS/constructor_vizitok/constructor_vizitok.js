(function() {
    window.drawCard = function(form) {
    let resultDiv = form.closest('.card_container').querySelector('.card-result > .card');
    let fields = [
        'organization',
        'fio',
        'position',
        'phone',
        'email',
        'address'
    ]
    fields.forEach(field => {
        resultDiv.querySelector('.card__' + field).textContent = form[field].value;
    })

    let fio_colors = document.getElementsByName('fio-color')
    let position_colors = document.getElementsByName('position-color')
    let text_align = document.getElementsByName('align')
    let text_size = document.getElementsByName('size')
    let text_align_2 = document.getElementsByName('align2')
    let text_size_2 = document.getElementsByName('size2')
    let visability = document.getElementsByName('email_visibility')
    let visability2 = document.getElementsByName('address_visibility')

    if (visability[0].checked!=true){
        resultDiv.querySelector('.card__email').style.display = visability[0].value
    }
    else{
        resultDiv.querySelector('.card__email').style.display = 'block'
    }
    if (visability2[0].checked!=true){
        resultDiv.querySelector('.card__address').style.display = visability2[0].value
    }
    else{
        resultDiv.querySelector('.card__address').style.display = 'block'
    }

    for (i = 0; i < fio_colors.length; i++) {
        if (fio_colors[i].checked){
            resultDiv.querySelector('.card__fio').style.color = fio_colors[i].value
        }
        if (position_colors[i].checked) {
            resultDiv.querySelector('.card__position').style.color = position_colors[i].value
        }
    }
    for (i = 0; i < text_align.length; i++){
        if (text_align[i].checked) {
            resultDiv.querySelector('.card__fio').style.textAlign = text_align[i].value
        }
        if (text_size[i].checked) {
            resultDiv.querySelector('.card__fio').style.fontSize = text_size[i].value
        }
    }
    for (i = 0; i < text_align_2.length; i++){
        if (text_align_2[i].checked) {
            resultDiv.querySelector('.card__position').style.textAlign = text_align_2[i].value
        }
        if (text_size_2[i].checked) {
            resultDiv.querySelector('.card__position').style.fontSize = text_size_2[i].value
        }
    }



    

};

})();
