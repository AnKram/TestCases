$(window).load(function () {

    //send file
    let files;

    $('#upload-file input[type=file]').change(function () {
        files = this.files;
    });

    $('#fl_inp').change(function(){
        let filename = $(this).val().replace(/.*\\/, '');
        $('#fl_nm').html(filename);
    });

    $('#send-file').on('click', function () {
        let data = new FormData();
        $.each(files, function (key, value) {
            data.append(key, value);
        });

        $.ajax({
            url: './download.php?files',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (res) {
                alert(res);
            }
        });

    });

    // добавление строки
    $('#send-row').on('click', function () {

        //проверка данных
        let pos = $('#position');
        let pos_val = pos.val();
        let title = $('#title');
        let title_val = title.val();
        let price = $('#value');
        let price_val = price.val();

        if (!pos_val) {
            pos.addClass('empty');
        } else {
            pos.removeClass('empty');
        }

        if (!title_val) {
            title.addClass('empty');
        } else {
            title.removeClass('empty');
        }

        if (!price_val) {
            price.addClass('empty');
        } else {
            price.removeClass('empty');
        }

        if (pos_val && title_val && price_val) {
            //let formData = JSON.stringify({'position': pos_val, 'title': title_val, 'price': price_val});
            let formData = {'position': pos_val, 'title': title_val, 'price': price_val};

            $.ajax({
                url: 'download.php?row',
                type: 'post',
                dataType: 'html',
                data: {data: formData},

                success: function (res) {
                    if (res == 1) {
                        alert('строка добавлена');
                        pos.val('');
                        title.val('');
                        price.val('');
                    }
                }
            });
        }
    });

});