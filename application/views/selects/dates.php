<script>
    base_url = "<?php  echo base_url();?>";
    $(document).ready(function(){

        $("#dates_form").select2({
            placeholder: "DATE FORM",
            minimumInputLength: 3,
            ajax: {
                url: base_url+"index.php/monitoring/date_monitoring_ajax_from/",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        fromTo: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $("#dates_form_mobile").select2({
            placeholder: "DATE FORM",
            minimumInputLength: 3,
            ajax: {
                url: base_url+"index.php/monitoring/date_monitoring_ajax_from/",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        fromTo: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $("#dates_to").select2({
            placeholder: "DATE TO",
            minimumInputLength: 3,
            ajax: {
                url: base_url+"index.php/monitoring/date_monitoring_ajax_to/",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        toFrom: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $("#dates_to_mobile").select2({
            placeholder: "DATE TO",
            minimumInputLength: 3,
            ajax: {
                url: base_url+"index.php/monitoring/date_monitoring_ajax_to/",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        toFrom: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>