import{_ as P}from"./MainLayout-73462f0f.js";import{W as k,k as o,o as c,c as d,w as e,a as _,b as t,h as n,t as y,D as g,g as z}from"./app-d02c39e6.js";import N from"./create-d3d8afc1.js";import S from"./edit-d39672c7.js";import{_ as j}from"./_plugin-vue_export-helper-c27b6911.js";import"./FormComponent-85014e44.js";const B={props:{data:Object,form_data:Object,headers:Object,modelRoute:String,title:String},components:{MainLayout:P,myCreate:N,clientEdit:S},data(){return{search:"",page:1,itemsPerPage:5}},methods:{goTo(i){k.visit(i)},openEdit(i){console.log("🚀 ~ openEdit ~ data:",i),this.$refs.editModal.show(i)},openCreate(){this.$refs.createModal.show()},geoFence(i){k.visit(`/geofences/${i}`)}},computed:{pageCount(){return Math.ceil(this.data.data.length/this.itemsPerPage)}}},L={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg"},T={class:"actions"},D=_("span",null,"Edit",-1),F=_("span",null,"View geofences",-1),A=_("span",null,"View geofences",-1);function I(i,m,a,U,f,v){const b=o("v-toolbar-title"),x=o("v-divider"),C=o("v-spacer"),M=o("myCreate"),u=o("v-btn"),w=o("v-toolbar"),R=o("v-text-field"),s=o("v-icon"),h=o("v-tooltip"),V=o("v-data-table"),E=o("clientEdit"),O=o("MainLayout");return c(),d(O,{title:"Order Management",rail:!1},{default:e(()=>[_("div",L,[t(V,{headers:a.headers,items:a.data.data,"sort-by":[{key:"name",order:"asc"}],class:"elevation-2",search:f.search},{top:e(()=>[t(w,{flat:""},{default:e(()=>[t(b,null,{default:e(()=>[n(y(a.title)+" Management",1)]),_:1}),t(x,{class:"mx-4",inset:"",vertical:""}),t(C),a.modelRoute!=="geofences"?(c(),d(M,{key:0,form_data:a.form_data,title:a.title,modelRoute:a.modelRoute,ref:"createModal"},null,8,["form_data","title","modelRoute"])):(c(),d(u,{key:1,"prepend-icon":"mdi-plus-circle",variant:"tonal",onClick:m[0]||(m[0]=l=>v.goTo("geocoder")),color:"info",rounded:""},{default:e(()=>[n(" Add "+y(a.title),1)]),_:1}))]),_:1}),t(R,{modelValue:f.search,"onUpdate:modelValue":m[1]||(m[1]=l=>f.search=l),"append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},null,8,["modelValue"])]),"item.actions":e(({item:l})=>[_("div",T,[t(h,{location:"bottom"},{activator:e(({props:r})=>[t(u,g({icon:""},r,{onClick:p=>v.openEdit(l.id)}),{default:e(()=>[t(s,{color:"info"},{default:e(()=>[n(" mdi-pencil ")]),_:1})]),_:2},1040,["onClick"])]),default:e(()=>[D]),_:2},1024),t(h,{location:"bottom"},{activator:e(({props:r})=>[t(u,g({icon:""},r,{onClick:p=>i.deleteItem(l)}),{default:e(()=>[t(s,{color:"red-lighten-1"},{default:e(()=>[n(" mdi-delete ")]),_:1})]),_:2},1040,["onClick"])]),default:e(()=>[F]),_:2},1024),a.modelRoute==="geofences"?(c(),d(h,{key:0,location:"bottom"},{activator:e(({props:r})=>[t(u,g({icon:""},r,{onClick:p=>v.geoFence(l.id)}),{default:e(()=>[t(s,{color:"success-lighten-1"},{default:e(()=>[n(" mdi-map-marker-check ")]),_:1})]),_:2},1040,["onClick"])]),default:e(()=>[A]),_:2},1024)):z("",!0)])]),"item.availability_status":e(({value:l})=>[l?(c(),d(s,{key:0,color:"success",size:"x-small"},{default:e(()=>[n("mdi-circle")]),_:1})):(c(),d(s,{key:1,color:"red",size:"x-small"},{default:e(()=>[n("mdi-circle")]),_:1}))]),"item.active":e(({value:l})=>[l?(c(),d(s,{key:0,color:"success",size:"x-small"},{default:e(()=>[n("mdi-circle")]),_:1})):(c(),d(s,{key:1,color:"red",size:"x-small"},{default:e(()=>[n("mdi-circle")]),_:1}))]),_:1},8,["headers","items","search"])]),t(E,{ref:"editModal",modelRoute:a.modelRoute,title:a.title},null,8,["modelRoute","title"])]),_:1})}const Q=j(B,[["render",I]]);export{Q as default};
