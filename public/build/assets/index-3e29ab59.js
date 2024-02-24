import{_ as C}from"./MainLayout-73462f0f.js";import{N as w,k as n,o as P,c as O,w as o,b as e,h as d,a as R}from"./app-d02c39e6.js";import{_ as U}from"./_plugin-vue_export-helper-c27b6911.js";const M={props:{sale_officer:Object,clients:Object,projects:Object},components:{MainLayout:C,VDataTable},data(){return{form:{start_date:null,end_date:null,agent_id:null,report:null},search:"",page:1,itemsPerPage:5,data:[],headers:[],reports:[{label:"Project Overview",value:"projectOverview"},{label:"Plot Status",value:"plotStatus"},{label:"Sales Report",value:"salesReport"},{label:"Payment Report",value:"paymentReport"}]}},methods:{getReport(){this.form.report&&w.post(this.form.report,this.form).then(s=>{console.log("🚀 ~ file: index.vue:58 ~ axios.get ~ res:",s.data.headers),this.data=s.data.data,this.headers=s.data.headers})}},computed:{pageCount(){return Math.ceil(this.data.data.length/this.itemsPerPage)}}},S={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg"};function N(s,a,m,B,t,u){const i=n("v-select"),r=n("v-col"),c=n("v-text-field"),p=n("v-btn"),v=n("v-row"),f=n("v-toolbar-title"),b=n("v-divider"),V=n("v-spacer"),h=n("v-toolbar"),_=n("v-icon"),g=n("v-avatar"),x=n("v-data-table"),y=n("v-card"),j=n("MainLayout");return P(),O(j,{title:"Order Management"},{default:o(()=>[e(y,null,{default:o(()=>[e(v,{"no-gutters":""},{default:o(()=>[e(r,{cols:"12",sm:"3"},{default:o(()=>[e(i,{clearable:"",chips:"",label:"Report",items:t.reports,variant:"outlined","item-title":"label","item-value":"value",modelValue:t.form.report,"onUpdate:modelValue":a[0]||(a[0]=l=>t.form.report=l)},null,8,["items","modelValue"])]),_:1}),e(r,{cols:"12",sm:"3"},{default:o(()=>[e(i,{clearable:"",chips:"",label:"Agent",items:m.sale_officer,variant:"outlined","item-title":"name","item-value":"id",modelValue:t.form.agent_id,"onUpdate:modelValue":a[1]||(a[1]=l=>t.form.agent_id=l)},null,8,["items","modelValue"])]),_:1}),e(r,{cols:"12",sm:"3"},{default:o(()=>[e(i,{clearable:"",chips:"",label:"Clients",items:m.clients,variant:"outlined","item-title":"name","item-value":"id",modelValue:t.form.client_id,"onUpdate:modelValue":a[2]||(a[2]=l=>t.form.client_id=l)},null,8,["items","modelValue"])]),_:1}),e(r,{cols:"12",sm:"3"},{default:o(()=>[e(i,{clearable:"",chips:"",label:"Projects",items:m.projects,variant:"outlined","item-title":"name","item-value":"id",modelValue:t.form.project_id,"onUpdate:modelValue":a[3]||(a[3]=l=>t.form.project_id=l)},null,8,["items","modelValue"])]),_:1}),e(r,{cols:"12",sm:"3"},{default:o(()=>[e(c,{clearable:"",modelValue:t.form.start_date,"onUpdate:modelValue":a[4]||(a[4]=l=>t.form.start_date=l),label:"Start Date",variant:"outlined",type:"date"},null,8,["modelValue"])]),_:1}),e(r,{cols:"12",sm:"3"},{default:o(()=>[e(c,{clearable:"",modelValue:t.form.end_date,"onUpdate:modelValue":a[5]||(a[5]=l=>t.form.end_date=l),label:"End Date",variant:"outlined",type:"date"},null,8,["modelValue"])]),_:1}),e(p,{color:"info",onClick:u.getReport},{default:o(()=>[d("Filer")]),_:1},8,["onClick"])]),_:1}),R("div",S,[e(x,{headers:t.headers,items:t.data.data,"sort-by":[{key:"product_name",order:"asc"}],class:"elevation-2",search:t.search},{top:o(()=>[e(h,{flat:""},{default:o(()=>[e(f,null,{default:o(()=>[d("Order Management")]),_:1}),e(b,{class:"mx-4",inset:"",vertical:""}),e(V)]),_:1}),e(c,{modelValue:t.search,"onUpdate:modelValue":a[6]||(a[6]=l=>t.search=l),"append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},null,8,["modelValue"])]),"item.actions":o(({item:l})=>[e(_,{size:"small",class:"me-2",onClick:k=>s.editItem(l)},{default:o(()=>[d(" mdi-pencil ")]),_:2},1032,["onClick"]),e(_,{size:"small",onClick:k=>s.deleteItem(l)},{default:o(()=>[d(" mdi-delete ")]),_:2},1032,["onClick"])]),"item.profile_photo_url":o(({value:l})=>[e(g,{image:l},null,8,["image"])]),_:1},8,["headers","items","search"])])]),_:1})]),_:1})}const z=U(M,[["render",N],["__scopeId","data-v-82bffa4e"]]);export{z as default};