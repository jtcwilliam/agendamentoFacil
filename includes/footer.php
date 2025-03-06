<script>




</script>

<script>
    $(function() {
        $(".datepicker").datepicker({
            showOn: "focus",
            dateFormat: "dd/mm/yy",
            dayNames: ["Domingo", "Segunda", "Terça", "Quarte", "Quinta", "Sexta", "Sábado"],
            dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
        });
    });


    //carregar combo das unidades
    function comboUnidades() {

        var formData = {
            tipo: 1
        };

        $.ajax({
                type: 'POST',
                url: 'ajax/unidadeController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                console.log(data);


                $('#selectUnidade').html(data);

            });

    }
</script>


<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>