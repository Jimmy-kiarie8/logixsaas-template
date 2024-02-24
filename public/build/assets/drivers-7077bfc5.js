import{m as u}from"./mapbox-gl-b26c6dbe.js";/* empty css                  */import{_ as B}from"./_plugin-vue_export-helper-c27b6911.js";import{k as n,o as w,c as E,w as t,b as e,h as _,t as d,f as A,i as F,F as I,a as o}from"./app-d02c39e6.js";const X={components(){},name:"maps",props:{sale:Object},data(){return{tab:null,map:null,items:[{title:"Dashboard",disabled:!1,href:"/"},{title:"Orders",disabled:!1,href:"/sales"},{title:"Maps",disabled:!0,href:"Maps"}]}},mounted(){this.initializeMap()},methods:{initializeMap(){u.accessToken="pk.eyJ1IjoiamltbGFyYXZlbCIsImEiOiJjbDdydXA5djkwaXR2M3FwMmxwc2h3YjdqIn0.rgDAW_8AKT6dHtGHXX1DtQ",this.map=new u.Map({container:this.$refs.mapContainer,style:"mapbox://styles/mapbox/streets-v10",center:[36.81958413560417,-1.2918808498502665],zoom:5}),this.drawRoute()},drawRoute(){if(!this.map.isStyleLoaded()){this.map.on("load",()=>this.drawRoute());return}const c=[this.sale.sender.longitude,this.sale.sender.latitude],s=[this.sale.receiver.longitude,this.sale.receiver.latitude],a=`https://api.mapbox.com/directions/v5/mapbox/driving/${c.join(",")};${s.join(",")}?geometries=geojson&access_token=${u.accessToken}`;fetch(a).then(l=>l.json()).then(l=>{if(l.routes&&l.routes.length){const r=l.routes[0].geometry.coordinates,m={type:"Feature",properties:{},geometry:{type:"LineString",coordinates:r}};this.map.getSource("route")?this.map.getSource("route").setData(m):this.map.addLayer({id:"route",type:"line",source:{type:"geojson",data:m},layout:{"line-join":"round","line-cap":"round"},paint:{"line-color":"#1E88E5","line-width":5,"line-opacity":.75}}),this.addReceiverMarker(s),this.addSenderBlinker(c),this.map.flyTo({center:[this.sale.sender.longitude,this.sale.sender.latitude],zoom:13,essential:!0})}}).catch(l=>{console.error(l)})},addReceiverMarker(){new u.Marker().setLngLat([this.sale.receiver.longitude,this.sale.receiver.latitude]).addTo(this.map)},addSenderBlinker(){const c=document.createElement("div");c.className="sender-blinker",new u.Marker(c).setLngLat([this.sale.sender.longitude,this.sale.sender.latitude]).addTo(this.map)}}},N={class:"d-flex"},O=o("strong",{class:"me-4"},"14:00",-1),q={class:"text-caption"},G={class:"d-flex"},H=o("strong",{class:"me-4"},"14:00",-1),J={class:"text-caption"},U={ref:"mapContainer",class:"map-container"};function Y(c,s,a,l,r,m){const y=n("v-breadcrumbs"),k=n("v-divider"),v=n("v-tab"),x=n("v-tabs"),f=n("v-timeline-item"),M=n("v-timeline"),j=n("v-window-item"),L=n("v-window"),h=n("v-card-text"),p=n("v-btn"),R=n("v-spacer"),V=n("v-card-actions"),b=n("v-card"),g=n("v-col"),C=n("v-row"),S=n("v-container"),D=n("v-main"),T=n("v-app"),z=n("MainLayout");return w(),E(z,{title:"Sale Management",rail:!0},{default:t(()=>[e(T,null,{default:t(()=>[e(D,null,{default:t(()=>[e(S,{fluid:""},{default:t(()=>[e(C,null,{default:t(()=>[e(g,{cols:"3"},{default:t(()=>[e(b,null,{default:t(()=>[e(y,{items:r.items},{title:t(({item:i})=>[_(d(i.title),1)]),_:1},8,["items"]),e(k),e(x,{modelValue:r.tab,"onUpdate:modelValue":s[0]||(s[0]=i=>r.tab=i)},{default:t(()=>[e(v,{value:"0"},{default:t(()=>[_(" Active")]),_:1}),e(v,{value:"1"},{default:t(()=>[_("In-active")]),_:1})]),_:1},8,["modelValue"]),e(h,null,{default:t(()=>[e(L,{modelValue:r.tab,"onUpdate:modelValue":s[1]||(s[1]=i=>r.tab=i)},{default:t(()=>[(w(),A(I,null,F(2,i=>e(j,{key:i,value:i},{default:t(()=>[e(M,{side:"end",align:"start"},{default:t(()=>[e(f,{"dot-color":"pink",size:"small"},{default:t(()=>[o("div",N,[O,o("div",null,[o("strong",null,d(a.sale.sender.name),1),o("div",q,[o("p",null,d(a.sale.sender.address),1),o("small",null,d(a.sale.sender.phone),1)])])])]),_:1}),e(f,{"dot-color":"success",size:"small"},{default:t(()=>[o("div",G,[H,o("div",null,[o("strong",null,d(a.sale.receiver.name),1),o("div",J,[o("p",null,d(a.sale.receiver.address),1),o("small",null,d(a.sale.receiver.phone),1)])])])]),_:1})]),_:1})]),_:2},1032,["value"])),64))]),_:1},8,["modelValue"])]),_:1}),e(V,null,{default:t(()=>[e(p,{"prepend-icon":"mdi-pin",variant:"tonal",onClick:m.drawRoute},{default:t(()=>[_(" Route ")]),_:1},8,["onClick"]),e(p,{"prepend-icon":"mdi-send",variant:"tonal",onClick:s[2]||(s[2]=()=>{})},{default:t(()=>[_(" Assing ")]),_:1}),e(R),e(p,{"prepend-icon":"mdi-send",variant:"tonal",color:"red"},{default:t(()=>[_(" Delayed ")]),_:1})]),_:1})]),_:1})]),_:1}),e(g,{col:"9"},{default:t(()=>[e(b,null,{default:t(()=>[e(h,null,{default:t(()=>[o("div",U,null,512)]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})}const P=B(X,[["render",Y]]);export{P as default};
