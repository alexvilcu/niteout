
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
            $('#users').select2({
              placeholder: "Invite people o your hangout",
              tags: false
            });
            $('#location').select2({
              placeholder: "Search for the location here",
              tags: false
            });
       });