$(function () {
    $('#modalButtonCommand').click(function () {
        $('#modalCommand').modal('show')
                .find('#modalContentCommand')
                .load($(this).attr('value'));
    });
    
    $('#modalButtonPlantConfigs').click(function () {
        $('#modalPlantConfigs').modal('show')
                .find('#modalContentPlantConfigs')
                .load($(this).attr('value'));
    });
    $('#modalButtonPots').click(function () {
        $('#modalPots').modal('show')
                .find('#modalContentPots')
                .load($(this).attr('value'));
    });
});
