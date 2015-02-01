    <? $this->widget('zii.widgets.jui.CJuiDatePicker',array(
        'name'=>'datepickerinput',
        'value'=>'',
        'options'=>array(
            'showAnim'=>'fold',
            'dateFormat'=>'dd.mm.yy'
        ),
        'htmlOptions'=>array(
            'class'=>'date',
            'style'=>'width: 381px;',
        ),
    )); ?>

<script type="text/javascript">
/*<![CDATA[*/
$().ready(function(){
    $('#dateinput').datepicker({'showAnim':'fold','dateFormat':'dd.mm.yy'});
});
/*]]>*/
</script>
