var DropzoneDemo = function() {
    // var formData = new FormData();
    // formData.append("_token", "{{ csrf_token() }}");
    var uploadedDocumentMap = [];

    var e = function() {
     
        Dropzone.options.mDropzoneOne = {

            paramName: "file",


            maxFiles: 1,

            maxFilesize: 5,
            
            // headers: {
            //     'X-CSRF-TOKEN': "{{ csrf_token() }}"
            //     },
            
            accept: function(e, o) {

                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()

            },
             // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //  },
            
               sending: function(file, xhr, formData) {

                    formData.append("_token", $("input[name='_token']").val());
                },
    

            success: function(file, response) {

                    
                $('[name=higforce_header_image]').val(response);

                // alert(response);

            },

        }, Dropzone.options.mDropzoneTwo = {

            paramName: "file",

            maxFiles: 10,

            maxFilesize: 10,
             
             uploadMultiple: true,
             addRemoveLinks:true,
            removedfile	:function(file) {
                file.previewElement.remove();
                uploadedDocumentMap.splice( uploadedDocumentMap.indexOf(file.name), 1 );
                $('[name="image_slide[]"]').val(uploadedDocumentMap);
            },
               
                accept: function(e, o) { "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o() },
               sending: function(file, xhr, formData) {

                    formData.append("_token", $("input[name='_token']").val());
                },
                       
                    success: function(file, response) {
                            //   $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                         uploadedDocumentMap.push(file.name);
                         $('[name="image_slide[]"]').val(uploadedDocumentMap);

                
                         
                         
                            // for (var i = 0; i < uploadedDocumentMap.length; i++) {
                            //     // uploadedDocumentMap[i];
                            //        console.log( "hhhh", uploadedDocumentMap[i]);

                            // }
                            
                        

                
        }

        }, Dropzone.options.mDropzoneThree = {

            paramName: "file",

            maxFiles: 10,

            maxFilesize: 10,

            acceptedFiles: "image/*,application/pdf,.psd",

            accept: function(e, o) { "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o() }

        }

    };

    return { init: function() { e() } }

}();

DropzoneDemo.init();