$(document).ready(function() {
    var rad = document.identitas.jenis_identitas;
    var prev = null;
    $('#korban').hide();
    for(var i = 0; i < rad.length; i++){
        rad[i].addEventListener('change', function(){
            if(this !== prev){
                prev = this;
            }
            if(this.value == 'Korban'){
                $('#pelapor').hide();
                $('#korban').show();
            }else if(this.value == 'Pelapor'){
                $('#pelapor').show();
                $('#korban').hide();

            }
        });
    }
});

$(document).ready(function() {
    var x = 1
    $('#add_upload_field').click(function() {
        x++;
        $('#bukti_field').append('<div class="row mt-2" id="field_' + x + '"> <div class="col-md-12"><input type="file" class="dropify" name="lampiran[]" id="lampiran_' + x + '"><a class="btn btn-sm btn-danger text-white w-100 rounded-0" onclick="remove_field(' + x + ')"><i class="fa fa-trash" style="font-size: 8pt;"></i> Hapus Foto</a></div></div>');
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': '<small style="font-size: 12pt">Drag and drop a file here or click</small>',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });
        });
    });

});

function remove_field(a) {
    $('#field_' + a).remove();
}

$(document).ready(function() {
    $(".js-example-placeholder-multiple").select2({
        placeholder: '-- Pilih Jenis Kasus/Kekerasan --'
    });

});

$(document).ready(function() {
    $('.dropify').dropify({
        messages: {
            'default': '<small style="font-size: 12pt">Drag and drop a file here or click</small>',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
});