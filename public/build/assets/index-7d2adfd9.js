import{_ as F}from"./MainLayout-73462f0f.js";import M from"./bar-chart-eff3a94d.js";import N from"./line-chart-d1e2281e.js";import L from"./doughnut-chart-7ed00bef.js";import{_ as V}from"./_plugin-vue_export-helper-c27b6911.js";import{k as n,o as s,c as v,w as e,b as t,f as _,i as h,F as f,h as l,t as r,a as w,g as B}from"./app-d02c39e6.js";import"./index-db230f15.js";const E={props:{total:Number,data:Object,deliveriesByStatusData:Object,revenueOverTimeData:Object,monthlySalesData:Object,profitMarginOverTimeData:Object,driverPerformanceData:Object,salesByDeliveryStatus:Object,deliveryStatusCounts:Object,salesOverTime:Object},components:{MainLayout:F,doughnutChart:L,lineChart:N,barChart:M},data(){return{search:"",page:1,itemsPerPage:5}},methods:{}},I={class:"d-flex py-3 justify-space-between"},q={class:"d-flex py-3 justify-space-between"},A={class:"d-flex py-3 justify-space-between"};function G(H,J,u,K,Q,R){const d=n("v-icon"),b=n("v-card-item"),c=n("v-col"),m=n("v-row"),g=n("v-card-text"),y=n("v-list-item-subtitle"),i=n("v-list-item"),x=n("v-divider"),D=n("v-card-actions"),p=n("v-card"),C=n("lineChart"),T=n("doughnutChart"),P=n("barChart"),O=n("v-list-subheader"),k=n("v-avatar"),S=n("v-chip"),j=n("v-list"),z=n("MainLayout");return s(),v(z,{title:"Dashboard"},{default:e(()=>[t(m,{"no-gutters":""},{default:e(()=>[(s(!0),_(f,null,h(u.data,(a,o)=>(s(),_(f,{key:o},[o<4?(s(),v(c,{key:0,cols:"12",sm:"3",style:{padding:"3px"}},{default:e(()=>[t(p,{class:"mx-auto"},{default:e(()=>[t(b,{title:a.label},{subtitle:e(()=>[t(d,{icon:a.icon,size:"18",color:a.iconColor,class:"me-1 pb-1"},null,8,["icon","color"]),l(" "+r(a.label),1)]),_:2},1032,["title"]),t(g,{class:"py-0"},{default:e(()=>[t(m,{align:"center","no-gutters":""},{default:e(()=>[t(c,{class:"value-text",cols:"6"},{default:e(()=>[l(r(a.value),1)]),_:2},1024),t(c,{cols:"6",class:"text-right"},{default:e(()=>[t(d,{color:a.iconColor,icon:a.icon,size:"88"},null,8,["color","icon"])]),_:2},1024)]),_:2},1024)]),_:2},1024),w("div",I,[t(i,{density:"compact","prepend-icon":"mdi-store-24-hour"},{default:e(()=>[t(y,null,{default:e(()=>[l("Percentage")]),_:1})]),_:1}),t(i,{density:"compact","prepend-icon":"mdi-percent-circle"},{default:e(()=>[t(y,null,{default:e(()=>[l(r((a.value/u.total*100).toFixed(2))+"%",1)]),_:2},1024)]),_:2},1024)]),t(x),t(D)]),_:2},1024)]),_:2},1024)):B("",!0)],64))),128)),t(c,{cols:"12",sm:"6",style:{padding:"3px"}},{default:e(()=>[t(p,{class:"mx-auto"},{default:e(()=>[t(C,{chartData:u.monthlySalesData},null,8,["chartData"])]),_:1})]),_:1}),t(c,{cols:"12",sm:"6",style:{padding:"3px"}},{default:e(()=>[t(p,{class:"mx-auto"},{default:e(()=>[t(T,{chartData:u.deliveriesByStatusData},null,8,["chartData"])]),_:1})]),_:1})]),_:1}),t(m,{"no-gutters":""},{default:e(()=>[(s(!0),_(f,null,h(u.data,(a,o)=>(s(),_(f,{key:o},[o>4&&o<9?(s(),v(c,{key:0,cols:"12",sm:"3",style:{padding:"3px"}},{default:e(()=>[t(p,{class:"mx-auto"},{default:e(()=>[t(b,{title:a.label},{subtitle:e(()=>[t(d,{icon:a.icon,size:"18",color:a.iconColor,class:"me-1 pb-1"},null,8,["icon","color"]),l(" "+r(a.label),1)]),_:2},1032,["title"]),t(g,{class:"py-0"},{default:e(()=>[t(m,{align:"center","no-gutters":""},{default:e(()=>[t(c,{class:"value-text",cols:"6"},{default:e(()=>[l(r(a.value),1)]),_:2},1024),t(c,{cols:"6",class:"text-right"},{default:e(()=>[t(d,{color:a.iconColor,icon:a.icon,size:"88"},null,8,["color","icon"])]),_:2},1024)]),_:2},1024)]),_:2},1024),w("div",q,[t(i,{density:"compact","prepend-icon":"mdi-store-24-hour"},{default:e(()=>[t(y,null,{default:e(()=>[l("Percentage")]),_:1})]),_:1}),t(i,{density:"compact","prepend-icon":"mdi-percent-circle"},{default:e(()=>[t(y,null,{default:e(()=>[l(r((a.value/u.total*100).toFixed(2))+"%",1)]),_:2},1024)]),_:2},1024)]),t(x),t(D)]),_:2},1024)]),_:2},1024)):B("",!0)],64))),128)),t(c,{cols:"12",sm:"4",style:{padding:"3px"}},{default:e(()=>[t(p,{class:"mx-auto"},{default:e(()=>[t(C,{chartData:u.revenueOverTimeData},null,8,["chartData"])]),_:1})]),_:1}),t(c,{cols:"12",sm:"4",style:{padding:"3px"}},{default:e(()=>[t(p,{class:"mx-auto"},{default:e(()=>[t(P,{chartData:u.driverPerformanceData},null,8,["chartData"])]),_:1})]),_:1}),t(c,{cols:"12",sm:"4",style:{padding:"3px"}},{default:e(()=>[t(p,{class:"mx-auto"},{default:e(()=>[t(C,{chartData:u.profitMarginOverTimeData},null,8,["chartData"])]),_:1})]),_:1})]),_:1}),t(m,{"no-gutters":""},{default:e(()=>[(s(!0),_(f,null,h(u.data,(a,o)=>(s(),_(f,{key:o},[o>9?(s(),v(c,{key:0,cols:"12",sm:"6",style:{padding:"3px"}},{default:e(()=>[t(p,{class:"mx-auto"},{default:e(()=>[t(b,{title:a.label},{subtitle:e(()=>[t(d,{icon:a.icon,size:"18",color:a.iconColor,class:"me-1 pb-1"},null,8,["icon","color"]),l(" "+r(a.label),1)]),_:2},1032,["title"]),t(g,{class:"py-0"},{default:e(()=>[t(m,{align:"center","no-gutters":""},{default:e(()=>[t(c,{class:"value-text",cols:"6"},{default:e(()=>[l(r(a.value),1)]),_:2},1024),t(c,{cols:"6",class:"text-right"},{default:e(()=>[t(d,{color:a.iconColor,icon:a.icon,size:"88"},null,8,["color","icon"])]),_:2},1024)]),_:2},1024)]),_:2},1024),w("div",A,[t(i,{density:"compact","prepend-icon":"mdi-store-24-hour"},{default:e(()=>[t(y,null,{default:e(()=>[l("Percentage")]),_:1})]),_:1}),t(i,{density:"compact","prepend-icon":"mdi-percent-circle"},{default:e(()=>[t(y,null,{default:e(()=>[l(r((a.value/u.total*100).toFixed(2))+"%",1)]),_:2},1024)]),_:2},1024)]),t(x),t(D)]),_:2},1024)]),_:2},1024)):B("",!0)],64))),128))]),_:1}),t(m,{"no-gutters":""},{default:e(()=>[t(c,{cols:"12",sm:"4",style:{padding:"3px"}},{default:e(()=>[t(j,{color:"info"},{default:e(()=>[t(O,{inset:""},{default:e(()=>[l("Sales By Delivery Status")]),_:1}),(s(!0),_(f,null,h(u.salesByDeliveryStatus,(a,o)=>(s(),v(i,{key:o,title:a.delivery_status,value:o},{prepend:e(()=>[t(k,null,{default:e(()=>[t(d,{color:"white"},{default:e(()=>[l("mdi-information")]),_:1})]),_:1})]),append:e(()=>[t(S,null,{default:e(()=>[l(r(a.count),1)]),_:2},1024)]),_:2},1032,["title","value"]))),128))]),_:1})]),_:1}),t(c,{cols:"12",sm:"4",style:{padding:"3px"}},{default:e(()=>[t(j,{color:"info"},{default:e(()=>[t(O,{inset:""},{default:e(()=>[l("Delivery Status Counts")]),_:1}),(s(!0),_(f,null,h(u.deliveryStatusCounts,(a,o)=>(s(),v(i,{key:o,title:o,value:o},{prepend:e(()=>[t(k,null,{default:e(()=>[t(d,{color:"white"},{default:e(()=>[l("mdi-clock")]),_:1})]),_:1})]),append:e(()=>[t(S,null,{default:e(()=>[l(r(a),1)]),_:2},1024)]),_:2},1032,["title","value"]))),128))]),_:1})]),_:1}),t(c,{cols:"12",sm:"4",style:{padding:"3px"}},{default:e(()=>[t(j,{color:"info"},{default:e(()=>[t(O,{inset:""},{default:e(()=>[l("Sales Over Time")]),_:1}),(s(!0),_(f,null,h(u.salesOverTime,(a,o)=>(s(),v(i,{key:o,title:a.date,value:o},{prepend:e(()=>[t(k,null,{default:e(()=>[t(d,{color:"white"},{default:e(()=>[l("mdi-cart")]),_:1})]),_:1})]),append:e(()=>[t(S,null,{default:e(()=>[l(r(a.count),1)]),_:2},1024)]),_:2},1032,["title","value"]))),128))]),_:1})]),_:1})]),_:1})]),_:1})}const et=V(E,[["render",G],["__scopeId","data-v-3bad4ba4"]]);export{et as default};