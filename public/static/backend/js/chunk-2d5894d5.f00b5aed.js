(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d5894d5"],{"54c2":function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"view-page"},[n("div",{staticClass:"view-page__title"},[n("h3",[e._v(e._s(e.title))])]),n("div",{staticClass:"view-page__content"},[e._t("default")],2)])},i=[],o={props:{title:{type:String,default:""}}},a=o,s=n("2877"),u=Object(s["a"])(a,r,i,!1,null,null,null);t["a"]=u.exports},6899:function(e,t,n){"use strict";n("9c04")},"6b56":function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("d2-drawer",{on:{open:e.onLoad},model:{value:e.currentValue,callback:function(t){e.currentValue=t},expression:"currentValue"}},[n("div",{attrs:{slot:"header"},slot:"header"},[e._v("上传图片")]),n("template",{slot:"footer"},[n("el-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v("确认选择")])],1),n("div",{staticClass:"group-file",attrs:{flex:""}},[n("ul",{staticClass:"group-list",attrs:{"flex-box":"0"}},[n("li",{class:{"group-item":!0,active:-1===e.currentGroupId},on:{click:function(t){return e.onGroupChange(-1)}}},[e._v("全部")]),n("li",{class:{"group-item":!0,active:0===e.currentGroupId},on:{click:function(t){return e.onGroupChange(0)}}},[e._v("未分组")]),e._l(e.groupList,(function(t){return n("li",{key:t.group_id,class:{"group-item":!0,active:e.currentGroupId===t.group_id},on:{click:function(n){return e.onGroupChange(t.group_id)}}},[e._v(" "+e._s(t.name)+" "),e.currentGroupId!==t.group_id?n("i",{staticClass:"el-icon-error",on:{click:function(n){return e.onDeleteGroup(t.group_id)}}}):e._e()])})),n("li",{staticClass:"group-link",on:{click:e.onAddGroup}},[n("i",{staticClass:"el-icon-circle-plus-outline"}),e._v(" 新增分组 ")])],2),n("div",{staticClass:"file_list",attrs:{"flex-box":"1"}},[n("div",{attrs:{flex:""}},[n("div",{attrs:{"flex-box":"1"}},[n("el-dropdown",{on:{command:e.onMoveSelectedFileToGroup}},[n("el-button",{attrs:{type:"primary"}},[e._v(" 选择分组 "),n("i",{staticClass:"el-icon-arrow-down el-icon--right"})]),n("el-dropdown-menu",{attrs:{slot:"dropdown"},slot:"dropdown"},[n("el-dropdown-item",{attrs:{command:0}},[e._v("未分组")]),e._l(e.groupList,(function(t){return n("el-dropdown-item",{key:t.group_id,attrs:{command:t.group_id}},[e._v(e._s(t.name))])}))],2)],1),e._v(" "),n("el-button",{attrs:{type:"danger",icon:"el-icon-delete",plain:""},on:{click:e.onDeleteSelectedFile}},[e._v("删除")])],1),n("div",{attrs:{"flex-box":"0"}},[n("el-button",{attrs:{type:"primary",icon:"el-icon-upload",plain:""},on:{click:function(t){e.showUploadImage=!0}}},[e._v("上传图片")])],1)]),n("ul",{staticClass:"el-upload-list el-upload-list--picture-card"},e._l(e.fileList,(function(t){return n("li",{key:t.file_id,class:{"el-upload-list__item":!0,active:t.active},on:{click:function(n){return e.onFileSelected(t)}}},[n("div",{staticClass:"el-upload-list__item-thumbnail"},[n("img",{attrs:{src:t.file_url,alt:""}})]),n("p",{staticClass:"el-upload-list__item-content"},[e._v(e._s(t.file_name))]),n("div",{staticClass:"el-upload-list__item-inner"},[n("span",{staticClass:"el-upload-list__item-inner-check"},[n("i",{staticClass:"el-icon-check"})])])])})),0),n("el-pagination",{attrs:{background:"","current-page":e.pagination.page,"page-sizes":[15,50,100],"page-size":e.pagination.size,layout:"total, sizes, prev, pager, next, jumper",total:e.pagination.total},on:{"size-change":e.onSizeChange,"current-change":e.onCurrentChange}})],1)]),n("el-dialog",{attrs:{title:"上传图片",visible:e.showUploadImage,"append-to-body":"",width:"400px","before-close":e.onCloseUploadImage},on:{"update:visible":function(t){e.showUploadImage=t}}},[n("d2-upload",{attrs:{drag:"",action:"/upload.file/upload",data:e.uploadData,multiple:""}})],1)],2)},i=[],o=(n("4de4"),n("caad"),n("a15b"),n("d81d"),n("2532"),n("96cf"),n("1da1")),a=n("2ef0"),s=n("c98b"),u=n("1f47");function c(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return s["a"].onAny("/upload.group/list").reply((function(e){return u["c"](Object(a["assign"])({}))})),Object(s["c"])({url:"/upload.group/list",method:"get",params:e})}function l(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return s["a"].onAny("/upload.group/add").reply((function(e){return u["c"](Object(a["assign"])({}))})),Object(s["c"])({url:"/upload.group/add",method:"post",data:e})}function p(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return s["a"].onAny("/upload.group/delete").reply((function(e){return u["c"](Object(a["assign"])({}))})),Object(s["c"])({url:"/upload.group/delete",method:"post",params:e})}function d(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return s["a"].onAny("/upload.file/list").reply((function(e){return u["c"](Object(a["assign"])({}))})),Object(s["c"])({url:"/upload.file/list",method:"get",params:e})}function f(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return s["a"].onAny("/upload.file/move").reply((function(e){return u["c"](Object(a["assign"])({}))})),Object(s["c"])({url:"/upload.file/move",method:"post",params:e})}function g(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return s["a"].onAny("/upload.file/delete").reply((function(e){return u["c"](Object(a["assign"])({}))})),Object(s["c"])({url:"/upload.file/delete",method:"post",params:e})}var h=n("ad0b"),m=n("a3f8"),v=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-upload",{staticClass:"upload-form",attrs:{drag:e.drag,action:e.d2Action,headers:e.d2Headers,multiple:e.multiple,data:e.data,name:e.name,"show-file-list":e.showFileList,accept:e.accept,"on-preview":e.onPreview,"on-remove":e.onRemove,"on-success":e.onSuccess,"on-error":e.onError,"on-progress":e.onProgress,"on-change":e.onChange,"before-upload":e.beforeUpload,"before-remove":e.beforeRemove,"list-type":e.listType,"auto-upload":e.autoUpload,"file-list":e.fileList,disabled:e.disabled,limit:e.limit,"on-exceed":e.onExceed}},[n("i",{staticClass:"el-icon-upload"}),n("div",{staticClass:"el-upload__text"},[e._v("将文件拖到此处，或"),n("em",[e._v("点击上传")])])])},_=[],b=(n("a9e3"),n("c276")),y={props:{action:{type:String},headers:{type:Object},drag:{type:Boolean,default:!1},multiple:{type:Boolean},data:{type:Object},showFileList:{type:Boolean,default:!0},accept:{type:String},name:{type:String,default:"file"},listType:{type:String,default:"text"},autoUpload:{type:Boolean,default:!0},fileList:{type:Array,default:function(){return[]}},disabled:{type:Boolean,default:!1},limit:{type:Number,default:10},onExceed:{type:Function},onPreview:{type:Function},onRemove:{type:Function},onSuccess:{type:Function},onError:{type:Function},onProgress:{type:Function},onChange:{type:Function},beforeUpload:{type:Function},beforeRemove:{type:Function}},data:function(){return{d2Action:"",d2Headers:{}}},created:function(){var e=b["a"].cookies.get("token");this.d2Action="/backend"+this.action,this.d2Headers=Object.assign({},this.headers||{},{Authorization:"Bearer ".concat(e),Accept:"application/json"})},methods:{}},w=y,C=n("2877"),x=Object(C["a"])(w,v,_,!1,null,null,null),k=x.exports,O={components:{D2Drawer:m["a"],D2Upload:k},mixins:[h["a"]],data:function(){return{groupList:[],currentGroupId:-1,fileList:[],showUploadImage:!1,pagination:{pages:0,page:1,total:0,size:20}}},computed:{uploadData:function(){return{group_id:this.currentGroupId>-1?this.currentGroupId:0}}},created:function(){this.onLoad()},methods:{onLoad:function(){this._reset(),this.getGroupList(),this.getFileList()},onSizeChange:function(e){this._resetOnly({pagination:{size:e}}),this.getFileList()},onCurrentChange:function(e){this._resetOnly({pagination:{page:e}}),this.getFileList()},onGroupChange:function(e){this.currentGroupId!==e&&(this._reset({groupList:this.groupList,currentGroupId:e}),this.getFileList())},onAddGroup:function(){var e=this;this.$prompt("请输入分组名称","提示",{confirmButtonText:"确定",cancelButtonText:"取消",inputPattern:/.+/,inputErrorMessage:"请输入正确的分组名称"}).then(function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(n){var r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return r=n.value,t.next=3,l({type:10,name:r});case 3:e.getGroupList();case 4:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()).catch((function(){}))},onDeleteGroup:function(e){var t=this;this.$confirm("确定要删除该分组吗？").then(function(){var n=Object(o["a"])(regeneratorRuntime.mark((function n(r){return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:return n.next=2,p({id:e});case 2:t.getGroupList();case 3:case"end":return n.stop()}}),n)})));return function(e){return n.apply(this,arguments)}}())},onFileSelected:function(e){e.active=!e.active,this.multiple?e.active?this.currentSelected.push(e):this.currentSelected=this.currentSelected.filter((function(t){return t!==e})):this.currentSelected=e.active?[e]:[]},onCloseUploadImage:function(){this.showUploadImage=!1,this._resetOnly({pagination:{page:1}}),this.getFileList()},getGroupList:function(){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,c({type:10});case 2:e.groupList=t.sent;case 3:case"end":return t.stop()}}),t)})))()},getFileList:function(){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){var n,r,i,o,a,s;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,d({group_id:e.currentGroupId,page:e.pagination.page,page_size:e.pagination.size,is_user:0,is_recycle:0});case 2:n=t.sent,r=n.pages,i=n.page,o=n.size,a=n.total,s=n.data,e.pagination={pages:r,page:i,size:o,total:a},e.fileList=s.map((function(t){return t.active=e.currentSelected.includes(t),t}));case 10:case"end":return t.stop()}}),t)})))()},onMoveSelectedFileToGroup:function(e){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:if(0!==t.currentSelected.length){n.next=2;break}return n.abrupt("return",t.$message.error("请选择要移动的文件"));case 2:return n.next=4,f({file_ids:t.currentSelected.map((function(e){return e.file_id})).join(","),group_id:e});case 4:t.onCurrentChange(1);case 5:case"end":return n.stop()}}),n)})))()},onDeleteSelectedFile:function(){var e=this;if(0===this.currentSelected.length)return this.$message.error("请选择要删除的文件");this.$confirm("确定要删除选择的文件吗？").then(function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(n){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,g({file_ids:e.currentSelected.map((function(e){return e.file_id})).join(",")});case 2:e.onCurrentChange(1);case 3:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()).catch((function(e){}))},onSubmit:function(){this.currentValue=!1,this.$emit("on-success",this.currentSelected)}}},S=O,j=(n("9473"),Object(C["a"])(S,r,i,!1,null,"4fe131d7",null));t["a"]=j.exports},"80c2":function(e,t,n){},9473:function(e,t,n){"use strict";n("80c2")},"9c04":function(e,t,n){},a3f8:function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-drawer",{attrs:{visible:e.currentValue,"append-to-body":!0,"before-close":e.onBeforeClose,"custom-class":e.customClass,direction:e.direction,size:e.size,"with-header":!1,"show-close":!1,"destroy-on-close":!1},on:{"update:visible":function(t){e.currentValue=t},open:e.onOpen,close:e.onClose}},[n("div",{staticClass:"drawer_full"},[n("div",{staticClass:"drawer_full__header"},[e._t("header")],2),n("div",{staticClass:"drawer_full__body"},[e._t("default")],2),n("div",{staticClass:"drawer_full__footer"},[e._t("footer"),n("el-button",{on:{click:function(t){return e.onBeforeClose(!0)}}},[e._v("关闭")])],2)])])},i=[],o=(n("a9e3"),n("ad0b")),a={mixins:[o["a"]],props:{customClass:{Type:String,default:""},direction:{Type:String,default:"rtl"},size:{Type:String|Number,default:"80%"}},data:function(){return{}},methods:{onBeforeClose:function(e){var t=this;if(e)return this.currentValue=!1,this.$emit("on-close");this.$confirm("确定要关闭当前弹窗吗？").then((function(e){t.currentValue=!1,t.$emit("on-close")})).catch((function(e){}))},onOpen:function(){this.$emit("open")},onClose:function(){this.$emit("close")}}},s=a,u=(n("6899"),n("2877")),c=Object(u["a"])(s,r,i,!1,null,"63ae5274",null);t["a"]=c.exports}}]);