(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-a9435c48","chunk-74df7b98"],{"1d99":function(e,t,n){"use strict";n.d(t,"d",(function(){return i})),n.d(t,"f",(function(){return c})),n.d(t,"a",(function(){return l})),n.d(t,"c",(function(){return s})),n.d(t,"b",(function(){return u})),n.d(t,"e",(function(){return d}));var a=n("2ef0"),r=n("c98b"),o=n("1f47");function i(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return r["a"].onAny("/navigator.category/list").reply((function(e){return o["c"](Object(a["assign"])({}))})),Object(r["c"])({url:"/navigator.category/list",method:"get",params:e})}function c(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return r["a"].onAny("/navigator.category/view").reply((function(e){return o["c"](Object(a["assign"])({}))})),Object(r["c"])({url:"/navigator.category/view",method:"get",params:e})}function l(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return r["a"].onAny("/navigator.category/add").reply((function(e){return o["c"](Object(a["assign"])({}))})),Object(r["c"])({url:"/navigator.category/add",method:"post",data:e})}function s(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return r["a"].onAny("/navigator.category/edit").reply((function(e){return o["c"](Object(a["assign"])({}))})),Object(r["c"])({url:"/navigator.category/edit",method:"post",params:e,data:t})}function u(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return r["a"].onAny("/navigator.category/delete").reply((function(e){return o["c"](Object(a["assign"])({}))})),Object(r["c"])({url:"/navigator.category/delete",method:"post",params:e})}function d(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return r["a"].onAny("/data.navigator.category/types").reply((function(e){return o["c"](Object(a["assign"])({}))})),Object(r["c"])({url:"/data.navigator.category/types",method:"get",params:e})}},ad0b:function(e,t,n){"use strict";var a=n("2ef0");t["a"]={props:{value:{type:Boolean,default:!1},bringback:{type:Boolean,default:!1},multiple:{type:Boolean,default:!1},clearable:{type:Boolean,default:!1}},data:function(){return{currentValue:!1,currentSelected:[]}},watch:{value:function(e){this.currentValue=e},currentValue:function(e){this.$emit("input",e)},currentSelected:function(e){this.$emit("on-selected",e)}},methods:{_reset:function(e){Object(a["assign"])(this.$data,this.$options.data(),{currentValue:this.value},e||{})},_resetOnly:function(e){Object(a["merge"])(this.$data,{currentSelected:[]},e||{})},_onSelected:function(e){this.multiple,this.currentSelected=e},_onBringback:function(e){if(null===e&&0===this.currentSelected.length)return this.$message.error("请至少选择一项");this.$emit("on-success",null===e?this.currentSelected:e),this.currentValue=!1}}}},d0a9:function(e,t,n){"use strict";n.r(t);var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("d2-container",[n("el-form",{ref:"filterForm",attrs:{inline:""},model:{value:e.filters,callback:function(t){e.filters=t},expression:"filters"}},[n("el-form-item",{attrs:{label:"分类名称"}},[n("el-input",{attrs:{placeholder:"请输入分类名称"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSearch(t)}},model:{value:e.filters.keyword,callback:function(t){e.$set(e.filters,"keyword",t)},expression:"filters.keyword"}})],1),n("el-form-item",{attrs:{label:"导航类型"}},[n("el-select",{model:{value:e.filters.type,callback:function(t){e.$set(e.filters,"type",t)},expression:"filters.type"}},[n("el-option",{attrs:{label:"全部",value:""}}),e._l(e.types,(function(e){return n("el-option",{key:e.value,attrs:{label:e.label,value:e.value}})}))],2)],1),n("el-form-item",{attrs:{label:"上级分类"}},[n("el-input",{attrs:{readonly:"",placeholder:"请选择上级分类"},model:{value:e.filters.parent_category_name,callback:function(t){e.$set(e.filters,"parent_category_name",t)},expression:"filters.parent_category_name"}},[n("el-button",{attrs:{slot:"append",icon:"el-icon-search"},on:{click:function(t){e.showCategoryList=!0}},slot:"append"})],1)],1),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:e.onSearch}},[e._v("搜索")]),n("el-button",{attrs:{type:"default"},on:{click:e.onLoad}},[e._v("重置")])],1)],1),n("el-button",{attrs:{access:["/navigator.category/add"],type:"primary",icon:"el-icon-plus"},on:{click:function(t){e.showCategoryAdd=!0}}},[e._v("添加")]),n("p",[n("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.tableData,border:""},on:{"selection-change":e._onSelected}},[e.multiple?n("el-table-column",{attrs:{type:"selection",width:"55"}}):e._e(),n("el-table-column",{attrs:{prop:"type_text",label:"导航类型"}}),n("el-table-column",{attrs:{prop:"name",label:"分类名称"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[n("span",[e._v(e._s(e._f("spaceSizeFilter")(a)))])]}}])}),n("el-table-column",{attrs:{prop:"sort",label:"分类排序"}}),n("el-table-column",{attrs:{label:"添加时间"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[n("el-tag",[e._v(e._s(a.created_at))]),n("el-tag",{attrs:{type:"danger"}},[e._v(e._s(a.updated_at))])]}}])}),n("el-table-column",{attrs:{label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e.bringback?n("el-button",{attrs:{type:"text"},on:{click:function(t){return e._onBringback([a])}}},[e._v("选择")]):e._e(),n("el-button",{attrs:{access:["/navigator.category/edit","/navigator.category/view"],type:"text",icon:"el-icon-edit"},on:{click:function(t){return e.onEdit(a)}}},[e._v("编辑")]),n("el-popconfirm",{attrs:{access:["/navigator.category/delete"],title:"确定要删除该分类吗？"},on:{confirm:function(t){return e.onDelete(a)}}},[n("el-button",{attrs:{slot:"reference",type:"text",icon:"el-icon-delete"},slot:"reference"},[e._v("删除")])],1)]}}])})],1)],1),n("el-pagination",{attrs:{background:"","current-page":e.pagination.page,"page-sizes":[15,50,100],"page-size":e.pagination.size,layout:"total, sizes, prev, pager, next, jumper",total:e.pagination.total},on:{"size-change":e.onPageSizeChange,"current-change":e.onCurrentChange}}),n("category-list",{attrs:{bringback:"","with-top-level":"",clearable:""},on:{"on-success":e.onCategorySelected},model:{value:e.showCategoryList,callback:function(t){e.showCategoryList=t},expression:"showCategoryList"}}),n("category-add",{on:{"on-success":e.getCategoryList},model:{value:e.showCategoryAdd,callback:function(t){e.showCategoryAdd=t},expression:"showCategoryAdd"}}),n("category-edit",{attrs:{query:e.categoryEditData},on:{"on-success":e.getCategoryList},model:{value:e.showCategoryEdit,callback:function(t){e.showCategoryEdit=t},expression:"showCategoryEdit"}})],1)},r=[],o=(n("a15b"),n("d81d"),n("b0c0"),n("d3b7"),n("ac1f"),n("1276"),n("96cf"),n("1da1")),i=n("1d99"),c=n("ad0b"),l={components:{CategoryList:function(){return n.e("chunk-8eb6b692").then(n.bind(null,"bd7d"))},CategoryAdd:function(){return n.e("chunk-60f5fca6").then(n.bind(null,"b334"))},CategoryEdit:function(){return n.e("chunk-14c8ac0e").then(n.bind(null,"a40c"))}},mixins:[c["a"]],data:function(){return{showCategoryList:!1,showCategoryAdd:!1,showCategoryEdit:!1,categoryEditData:{},types:[],filters:{keyword:"",type:"",parent_category_id:"",parent_category_name:""},tableData:[],pagination:{pages:0,page:1,size:15,total:0}}},created:function(){this.onLoad()},filters:{spaceSizeFilter:function(e){return e.parent_id<=0?e.name:e.path.split(",").map((function(e){return"　　"})).join("")+e.name}},methods:{onLoad:function(){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return e._reset(),t.next=3,i["e"]();case 3:e.types=t.sent,e.getCategoryList();case 5:case"end":return t.stop()}}),t)})))()},getCategoryList:function(){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){var n,a,r,o,c,l,s;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return n=Object.assign({},e.filters,{page:e.pagination.page,limit:e.pagination.size}),t.next=3,i["d"](n);case 3:a=t.sent,r=a.pages,o=a.page,c=a.total,l=a.size,s=a.data,e.tableData=s,e.pagination={pages:r,page:o,total:c,size:l};case 11:case"end":return t.stop()}}),t)})))()},onCategorySelected:function(e){if(e.length>0){var t=e[0];this.filters.parent_category_id=t.id,this.filters.parent_category_name=t.complete_path_name}else this.filters.parent_category_id="",this.filters.parent_category_name=""},onSearch:function(){this._resetOnly({pagination:{page:1}}),this.getCategoryList()},onPageSizeChange:function(e){this._resetOnly({pagination:{size:e}}),this.onSearch()},onCurrentChange:function(e){this._resetOnly({pagination:{page:e}}),this.getCategoryList()},onEdit:function(e){this.categoryEditData={id:e.id},this.showCategoryEdit=!0},onDelete:function(e){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:return n.next=2,i["b"]({id:e.id});case 2:t._resetOnly(),t.getCategoryList();case 4:case"end":return n.stop()}}),n)})))()}}},s=l,u=n("2877"),d=Object(u["a"])(s,a,r,!1,null,null,null);t["default"]=d.exports}}]);