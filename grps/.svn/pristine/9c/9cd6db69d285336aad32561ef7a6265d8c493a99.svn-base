var demo = null;
$(function(){
    demo = $("#disasterform").Validform({
        tiptype:2,
        label:".label",
        showAllError:true,
        ajaxPost:true,
        datatype:{
			"realNumber":function(gets,obj,curform,regxp){
                var reg = /^\d{1,14}$|^(\d{1,13}\.\d)$|^(\d{1,12}\.\d{2})$/;
				if(reg.test(gets)){return true;}
				else return false;
			}
		},
        callback:function(data){
			alert(data.info);
			if (data.status == "y") {
				demo.resetForm();
			}
		}
    });

    demo.addRule([
    {
    	ele:"#disa_area",
    	datatype:"realNumber",
    	nullmsg:"受灾面积必须提供",
    	errormsg:"受灾面积范围为大于0且最多有两位小数的14位实数"
    },
    {
    	ele:"#disa_eloss",
    	datatype:"realNumber",
    	ignore:"ignore",
    	errormsg:"经济损失范围为大于0且最多有两位小数的14位实数"
    },
    {
        ele:"#disa_situ",
        datatype:"n1-2",
        nullmsg:"受灾原因不能为空",
        errormsg:"受灾原因不能为空"
    },
    {
    	ele:"#disa_description",
    	datatype:"*",
    	nullmsg:"灾情描述不能为空"
    }
    ]);
});