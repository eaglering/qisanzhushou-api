(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d229379"],{dd03:function(e,t,a){"use strict";a.r(t);var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("d2-drawer",{on:{open:e.onLoad},model:{value:e.currentValue,callback:function(t){e.currentValue=t},expression:"currentValue"}},[a("div",{attrs:{slot:"header"},slot:"header"},[e._v("编辑分类")]),a("template",{slot:"footer"},[a("el-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v("确认提交")])],1),a("el-form",{ref:"form",attrs:{model:e.form,rules:e.formRules,"label-width":"100px"}},[a("view-page",{attrs:{title:"基础信息"}},[a("el-form-item",{attrs:{label:"上级分类",prop:"path_name"}},[a("el-input",{attrs:{readonly:"",placeholder:"请选择上级分类"},model:{value:e.form.path_name,callback:function(t){e.$set(e.form,"path_name",t)},expression:"form.path_name"}},[a("el-button",{attrs:{slot:"append",icon:"el-icon-search"},on:{click:function(t){e.showCategoryList=!0}},slot:"append"})],1)],1),a("el-form-item",{attrs:{label:"分类名称",prop:"name"}},[a("el-input",{attrs:{type:"textarea",rows:"10",placeholder:"请输入分类名称"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1),a("el-form-item",{attrs:{label:"分类图片",prop:"image_id"}},[a("el-button",{attrs:{type:"primary"},on:{click:function(t){e.showUploadFile=!0}}},[e._v("选择文件")]),a("p",[a("ul",{staticClass:"el-upload-list el-upload-list--picture-card",attrs:{tag:"ul"}},e._l(e.images,(function(t){return a("li",{key:t.file_id,staticClass:"el-upload-list__item"},[a("img",{staticClass:"el-upload-list__item-thumbnail",attrs:{src:t.file_url,alt:""}}),a("span",{staticClass:"el-upload-list__item-actions"},[a("span",{staticClass:"el-upload-list__item-preview",on:{click:function(a){return e.onCategoryImagePreview(t)}}},[a("i",{staticClass:"el-icon-zoom-in"})]),a("span",{staticClass:"el-upload-list__item-delete",on:{click:function(a){return e.onCategoryImageRemove(t)}}},[a("i",{staticClass:"el-icon-delete"})])])])})),0)]),a("small",[e._v("尺寸750x750像素以上，大小2M以下 (可拖拽图片调整显示顺序 )")])],1),a("el-form-item",{attrs:{label:"分类排序",prop:"sort"}},[a("el-input",{attrs:{type:"number",placeholder:"请输入分类排序"},model:{value:e.form.sort,callback:function(t){e.$set(e.form,"sort",e._n(t))},expression:"form.sort"}})],1)],1)],1),a("upload-file",{on:{"on-success":e.onCategoryImageSelected},model:{value:e.showUploadFile,callback:function(t){e.showUploadFile=t},expression:"showUploadFile"}}),a("category-list",{attrs:{"with-top-level":""},on:{"on-success":e.onCategoryParentSelected},model:{value:e.showCategoryList,callback:function(t){e.showCategoryList=t},expression:"showCategoryList"}}),a("el-dialog",{attrs:{visible:e.previewDialog},on:{"update:visible":function(t){e.previewDialog=t}}},[a("img",{attrs:{width:"100%",src:e.previewImageUrl,alt:""}})])],2)},i=[],o=(a("4de4"),a("b0c0"),a("d3b7"),a("96cf"),a("1da1")),n=a("ad0b"),s=a("54c2"),l=a("6b56"),c=a("a3f8"),u=a("c621"),m={mixins:[n["a"]],components:{ViewPage:s["a"],UploadFile:l["a"],D2Drawer:c["a"],CategoryList:function(){return a.e("chunk-2d21df88").then(a.bind(null,"d424"))}},props:{query:{type:Object,default:function(){return{}}}},data:function(){return{showUploadFile:!1,showCategoryList:!1,previewDialog:!1,previewImageUrl:"",images:[],form:{id:0,name:"",parent_id:0,parent_name:"",image_id:0,path:"",sort:0},formRules:{name:[{required:!0,message:"请输入分类名称",trigger:"blur"}],parent_name:[{required:!0,message:"请选择上级分类",trigger:"blur"}],sort:[{required:!0,message:"请输入排序值",trigger:"blur"},{type:"number",message:"仅支持数字，数值越大越靠前",trigger:"blur"}]}}},created:function(){this._reset()},methods:{onLoad:function(){this._reset(),this.getCategoryView()},getCategoryView:function(){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){var a,r,i,o,n,s,l,c;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(e.query.id){t.next=2;break}return t.abrupt("return");case 2:return t.next=4,u["e"]({id:e.query.id});case 4:a=t.sent,r=a.id,i=a.name,o=a.parent_id,n=a.path_name,s=a.image_id,l=a.sort,c=a.file,e.images=c?[c]:[],e.form={id:r,name:i,parent_id:o,path_name:n,image_id:s,sort:l};case 14:case"end":return t.stop()}}),t)})))()},onCategoryImageSelected:function(e){this.images=e,this.form.image_id=e[0].id},onCategoryImagePreview:function(e){this.previewDialog=!0,this.previewImageUrl=e.file_url},onCategoryImageRemove:function(e){this.images=this.images.filter((function(t){return t.id!==e.id})),this.form.image_id=0},onCategoryParentSelected:function(e){var t=e[0];this.form.parent_id=t.id,this.form.path_name=t.complete_path_name,this.form.path=t.complete_path},onSubmit:function(){var e=this;this.$refs.form.validate(function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(a){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!a){t.next=5;break}return t.next=3,u["c"]({id:e.form.id},e.form);case 3:e.currentValue=!1,e.$emit("on-success");case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}())}}},p=m,d=a("2877"),f=Object(d["a"])(p,r,i,!1,null,null,null);t["default"]=f.exports}}]);