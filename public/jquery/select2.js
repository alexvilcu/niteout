
      $(document).ready(function(){
          $('#tag').select2({
            placeholder: "Please select music type",
            allowClear: true,
          });
          $('#mood').select2({
            placeholder: "Please select your mood",
            allowClear: true
          });
          $('#tag').select2({
              placeholder: "Please select music type",
              tags: true
            });
            $('#mood').select2({
              placeholder: "Please select location's mood",
              tags: false
            });
       });