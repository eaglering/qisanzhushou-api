(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-3955c925","chunk-92337aba"],{"0ccb":function(e,t,n){var r=n("50c4"),i=n("1148"),o=n("1d80"),a=Math.ceil,c=function(e){return function(t,n,c){var u,s,l=String(o(t)),d=l.length,g=void 0===c?" ":String(c),f=r(n);return f<=d||""==g?l:(u=f-d,s=i.call(g,a(u/g.length)),s.length>u&&(s=s.slice(0,u)),e?l+s:s+l)}};e.exports={start:c(!1),end:c(!0)}},1148:function(e,t,n){"use strict";var r=n("a691"),i=n("1d80");e.exports="".repeat||function(e){var t=String(i(this)),n="",o=r(e);if(o<0||o==1/0)throw RangeError("Wrong number of repetitions");for(;o>0;(o>>>=1)&&(t+=t))1&o&&(n+=t);return n}},"274d":function(e,t,n){"use strict";n.d(t,"d",(function(){return a})),n.d(t,"e",(function(){return c})),n.d(t,"a",(function(){return u})),n.d(t,"c",(function(){return s})),n.d(t,"b",(function(){return l}));var r=n("2ef0"),i=n("c98b"),o=n("1f47");function a(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return i["a"].onAny("/region/list").reply((function(e){return o["c"](Object(r["assign"])({}))})),Object(i["c"])({url:"/region/list",method:"get",params:e})}function c(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return i["a"].onAny("/region/view").reply((function(e){return o["c"](Object(r["assign"])({}))})),Object(i["c"])({url:"/region/view",method:"get",params:e})}function u(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return i["a"].onAny("/region/add").reply((function(e){return o["c"](Object(r["assign"])({}))})),Object(i["c"])({url:"/region/add",method:"post",data:e})}function s(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return i["a"].onAny("/region/edit").reply((function(e){return o["c"](Object(r["assign"])({}))})),Object(i["c"])({url:"/region/edit",method:"post",params:e,data:t})}function l(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return i["a"].onAny("/region/delete").reply((function(e){return o["c"](Object(r["assign"])({}))})),Object(i["c"])({url:"/region/delete",method:"post",params:e})}},"4d90":function(e,t,n){"use strict";var r=n("23e7"),i=n("0ccb").start,o=n("9a0c");r({target:"String",proto:!0,forced:o},{padStart:function(e){return i(this,e,arguments.length>1?arguments[1]:void 0)}})},"9a0c":function(e,t,n){var r=n("342f");e.exports=/Version\/10\.\d+(\.\d+)?( Mobile\/\w+)? Safari\//.test(r)},ad0b:function(e,t,n){"use strict";var r=n("2ef0");t["a"]={props:{value:{type:Boolean,default:!1},bringback:{type:Boolean,default:!1},multiple:{type:Boolean,default:!1},clearable:{type:Boolean,default:!1}},data:function(){return{currentValue:!1,currentSelected:[]}},watch:{value:function(e){this.currentValue=e},currentValue:function(e){this.$emit("input",e)},currentSelected:function(e){this.$emit("on-selected",e)}},methods:{_reset:function(e){Object(r["assign"])(this.$data,this.$options.data(),{currentValue:this.value},e||{})},_resetOnly:function(e){Object(r["merge"])(this.$data,{currentSelected:[]},e||{})},_onSelected:function(e){this.multiple,this.currentSelected=e},_onBringback:function(e){if(null===e&&0===this.currentSelected.length)return this.$message.error("请至少选择一项");this.$emit("on-success",null===e?this.currentSelected:e),this.currentValue=!1}}}},c547:function(e,t,n){"use strict";n.r(t);var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("d2-container",[n("el-button",{attrs:{access:["/region/add"],type:"primary",icon:"el-icon-plus"},on:{click:function(t){e.showRegionAdd=!0}}},[e._v("添加")]),n("p",[n("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.tableData,border:""},on:{"selection-change":e._onSelected}},[e.multiple?n("el-table-column",{attrs:{type:"selection",width:"55"}}):e._e(),n("el-table-column",{attrs:{prop:"name",label:"区域名称"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[e._v(" "+e._s(e._f("regionNameFilter")(n))+" ")]}}])}),n("el-table-column",{attrs:{prop:"merger_name",label:"区域全称"}}),n("el-table-column",{attrs:{prop:"zip_code",label:"邮编"}}),n("el-table-column",{attrs:{label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e.bringback?n("el-button",{attrs:{type:"text"},on:{click:function(t){return e._onBringback([r])}}},[e._v("选择")]):e._e(),n("el-button",{attrs:{access:["/region/edit","/region/view"],type:"text",icon:"el-icon-edit"},on:{click:function(t){return e.onEdit(r)}}},[e._v("编辑")]),n("el-popconfirm",{attrs:{access:["/region/delete"],title:"确定要删除该区域吗？"},on:{confirm:function(t){return e.onDelete(r)}}},[n("el-button",{attrs:{slot:"reference",type:"text",icon:"el-icon-delete"},slot:"reference"},[e._v("删除")])],1)]}}])})],1)],1),n("el-pagination",{attrs:{background:"","current-page":e.pagination.page,"page-sizes":[15,50,100],"page-size":e.pagination.size,layout:"total, sizes, prev, pager, next, jumper",total:e.pagination.total},on:{"size-change":e.onPageSizeChange,"current-change":e.onCurrentChange}}),n("region-add",{on:{"on-success":e.onSearch},model:{value:e.showRegionAdd,callback:function(t){e.showRegionAdd=t},expression:"showRegionAdd"}}),n("region-edit",{attrs:{query:e.regionEditData},on:{"on-success":e.onSearch},model:{value:e.showRegionEdit,callback:function(t){e.showRegionEdit=t},expression:"showRegionEdit"}})],1)},i=[],o=(n("b0c0"),n("d3b7"),n("4d90"),n("96cf"),n("1da1")),a=n("274d"),c=n("ad0b"),u={components:{RegionAdd:function(){return Promise.all([n.e("chunk-107fdb58"),n.e("chunk-41ed17e8")]).then(n.bind(null,"3b37"))},RegionEdit:function(){return Promise.all([n.e("chunk-107fdb58"),n.e("chunk-49f3fd44")]).then(n.bind(null,"f87f"))}},mixins:[c["a"]],filters:{regionNameFilter:function(e){var t=e.level>1?"┣":"";return t.padStart(t.length+e.level-1,"　")+" "+e.name}},data:function(){return{showRegionAdd:!1,showRegionEdit:!1,regionEditData:{},filters:{},tableData:[],pagination:{pages:0,page:1,size:15,total:0}}},created:function(){this.onLoad()},methods:{onLoad:function(){this._reset(),this.getRegionList()},getRegionList:function(){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){var n,r,i,o,c,u,s;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return n=Object.assign({},e.filters,{page:e.pagination.page,limit:e.pagination.size}),t.next=3,a["d"](n);case 3:r=t.sent,i=r.pages,o=r.page,c=r.total,u=r.size,s=r.data,e.tableData=s,e.pagination={pages:i,page:o,total:c,size:u};case 11:case"end":return t.stop()}}),t)})))()},onSearch:function(){this._resetOnly({pagination:{page:1}}),this.getRegionList()},onPageSizeChange:function(e){this._resetOnly({pagination:{size:e}}),this.onSearch()},onCurrentChange:function(e){this._resetOnly({pagination:{page:e}}),this.getRegionList()},onEdit:function(e){this.regionEditData={id:e.id},this.showRegionEdit=!0},onDelete:function(e){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:return n.next=2,a["b"]({id:e.id});case 2:t.onCurrentChange();case 3:case"end":return n.stop()}}),n)})))()}}},s=u,l=n("2877"),d=Object(l["a"])(s,r,i,!1,null,null,null);t["default"]=d.exports}}]);