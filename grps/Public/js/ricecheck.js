var bdemo = null;
var edemo = null;
var ldemo = null;
$(function(){
	//基本信息验证规则
    bdemo = $("#briceform").Validform({
        tiptype:2,
        label:".label",
        showAllError:true,
        datatype:{
			"realNumber":function(gets,obj,curform,regxp){
				/*参数gets是获取到的表单元素值，
				  obj为当前表单元素，
				  curform为当前验证的表单，
				  regxp为内置的一些正则表达式的引用。*/

                var reg = /^\d{1,14}$|^(\d{1,13}\.\d)$|^(\d{1,12}\.\d{2})$/;
				if(reg.test(gets)){return true;}
				else return false;
			}
		},
        ajaxPost:true,
        callback:function(data){
        	alert(data.info);
        	if (data.status == "y") {
        		bdemo.resetForm();
        	}
        }
    });
    bdemo.addRule([{
        ele:"#year", 
        datatype:"n4-4",
        errormsg:"大小为四位整数",
        nullmsg:"不能为空"
    },
    {
    	ele:"#population,#agri_population",
    	datatype:"n1-14",
    	nullmsg:"不能为空",
    	errormsg:"大小为1~10位整数"
    },
    {
    	ele:"#zone_area,#agri_area,#field_area,#total_sown_area",
    	datatype:"realNumber",
    	nullmsg:"不能为空",
    	errormsg:"范围为大于0且最多有两位小数的14位实数"
    },
    {
        ele:"#reason",
        datatype:"*",
        nullmsg:"不能为空"
    }
    ]);
    //早稻验证规则
    edemo = $("#ericeform").Validform({
        tiptype:2,
        label:".label",
        showAllError:true,
        datatype:{
			"realNumber":function(gets,obj,curform,regxp){
                var reg = /^\d{1,14}$|^(\d{1,13}\.\d)$|^(\d{1,12}\.\d{2})$/;
				if(reg.test(gets)){return true;}
				else return false;
			}
		},
        ajaxPost:true,
        callback:function(data){
        	alert(data.info);
        	if (data.status == "y") {
        		edemo.resetForm();
        	}
        }
    });
    edemo.addRule([{
        ele:"#year", 
        datatype:"n4-4",
        errormsg:"大小为四位整数",
        nullmsg:"不能为空"
    },
    {
    	ele:"#e_sown_area,#e_disaster_area,#e_production,#e_market_price,#e_purchase_price,#e_fertilizer_price",
    	datatype:"realNumber",
    	nullmsg:"不能为空",
    	errormsg:"范围为大于0且最多有两位小数的14位实数"
    },
    {
        ele:"#reason",
        datatype:"*",
        nullmsg:"不能为空"
    }
    ]);
    //晚稻验证规则
    ldemo = $("#lriceform").Validform({
        tiptype:2,
        label:".label",
        showAllError:true,
        datatype:{
			"realNumber":function(gets,obj,curform,regxp){
                var reg = /^\d{1,14}$|^(\d{1,13}\.\d)$|^(\d{1,12}\.\d{2})$/;
				if(reg.test(gets)){return true;}
				else return false;
			}
		},
        ajaxPost:true,
        callback:function(data){
        	alert(data.info);
        	if (data.status == "y") {
        		ldemo.resetForm();
        	}
        }
    });

    ldemo.addRule([{
        ele:"#year", 
        datatype:"n4-4",
        errormsg:"大小为四位整数",
        nullmsg:"不能为空"
    },
    {
    	ele:"#l_sown_area,#l_disaster_area,#l_production,#l_market_price,#l_purchase_price,#l_fertilizer_price",
    	datatype:"realNumber",
    	nullmsg:"不能为空",
    	errormsg:"范围为大于0且最多有两位小数的14位实数"
    },
    {
        ele:"#reason",
        datatype:"*",
        nullmsg:"不能为空"
    }
    ]);
});