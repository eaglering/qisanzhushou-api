(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0c4dcc"],{"3d49":function(e,t,a){"use strict";a.r(t);var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("d2-container",[a("template",{slot:"header"},[a("el-alert",{attrs:{type:"success",closable:!1,title:"私有路由存储指当前路由的存储区域，\n        并且同时还根据用户区分，\n        相当于结合了 “路由存储” 和 “私有存储”，\n        不同路由以及不同用户之间存储不会相互干扰，\n        使用 await this.$store.dispatch('d2admin/db/databasePage', { user: true }) 获得存储实例进行操作，\n        不同路由和用户条件下获取的存储实例指向位置不同，\n        可以指定路由区分依据 name | path | fullPath，\n        默认根据路由的 name 区分不同的路由"}})],1),a("el-row",[a("el-col",{attrs:{span:12}},[a("p",{staticClass:"d2-mt-0"},[e._v("增加不重复字段")]),a("el-button",{on:{click:e.handleSetRandom}},[e._v("增加")]),a("p",[e._v("增加自定义字段")]),a("el-input",{staticClass:"d2-mr-5",staticStyle:{width:"100px"},attrs:{placeholder:"字段名"},model:{value:e.keyNameToSet,callback:function(t){e.keyNameToSet=t},expression:"keyNameToSet"}}),a("el-input",{staticClass:"d2-mr-5",staticStyle:{width:"100px"},attrs:{placeholder:"值"},model:{value:e.valueToSet,callback:function(t){e.valueToSet=t},expression:"valueToSet"}}),a("el-button",{on:{click:e.handleSet}},[e._v("增加")]),a("p",[e._v("删除字段")]),a("el-select",{attrs:{placeholder:"请选择要删除的 key"},model:{value:e.keyNameToDelete,callback:function(t){e.keyNameToDelete=t},expression:"keyNameToDelete"}},e._l(e.keyNameList,(function(e){return a("el-option",{key:e.value,attrs:{label:e.label,value:e.value}})})),1),a("p",[e._v("清空当前用户数据")]),a("el-button",{on:{click:e.handleClear}},[e._v("清空")])],1),a("el-col",{attrs:{span:12}},[a("d2-highlight",{attrs:{code:e.dataDisplay}})],1)],1)],2)},r=[],s=(a("d81d"),a("b64b"),a("96cf"),a("1da1")),l=a("5530"),c=a("2ef0"),u=a("2f62"),o={data:function(){return{dataDisplay:"",keyNameToSet:"",valueToSet:"",keyNameList:[],keyNameToDelete:""}},watch:{keyNameToDelete:function(e){e&&this.handleDelete(e)}},mounted:function(){this.load()},methods:Object(l["a"])(Object(l["a"])({},Object(u["b"])("d2admin/db",["databasePage","databasePageClear"])),{},{load:function(){var e=this;return Object(s["a"])(regeneratorRuntime.mark((function t(){var a;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,e.databasePage({user:!0});case 2:a=t.sent,e.dataDisplay=JSON.stringify(a.value(),null,2),e.keyNameList=Object.keys(a.value()).map((function(e){return{value:e,label:e}}));case 5:case"end":return t.stop()}}),t)})))()},handleDelete:function(e){var t=this;return Object(s["a"])(regeneratorRuntime.mark((function a(){var n;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return a.next=2,t.databasePage({user:!0});case 2:n=a.sent,n.unset(e).write(),t.load(),t.keyNameToDelete="";case 6:case"end":return a.stop()}}),a)})))()},handleClear:function(){var e=this;return Object(s["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,e.databasePageClear({user:!0});case 2:e.load();case 3:case"end":return t.stop()}}),t)})))()},handleSet:function(){var e=this;return Object(s["a"])(regeneratorRuntime.mark((function t(){var a;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(""!==e.keyNameToSet){t.next=3;break}return e.$message.error("字段名不能为空"),t.abrupt("return");case 3:return t.next=5,e.databasePage({user:!0});case 5:a=t.sent,a.set(e.keyNameToSet,e.valueToSet).write(),e.load();case 8:case"end":return t.stop()}}),t)})))()},handleSetRandom:function(){var e=this;return Object(s["a"])(regeneratorRuntime.mark((function t(){var a,n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return a=Object(c["uniqueId"])(),t.next=3,e.databasePage({user:!0});case 3:n=t.sent,n.set("uniqueKey".concat(a),"value".concat(a)).write(),e.load();case 6:case"end":return t.stop()}}),t)})))()}})},i=o,d=a("2877"),m=Object(d["a"])(i,n,r,!1,null,null,null);t["default"]=m.exports}}]);