import{k as t,o as a,c as o,w as s,f as v,i as b,F as _,a as V,g as n,t as j}from"./app-d02c39e6.js";const F={__name:"FormComponent",props:{form_data:Object},emits:["update:plots"],setup(m,{emit:w}){const i=m,y=u=>{u.model=="project_id"&&f(u.value)},f=async u=>{try{const r=(await axios.get(`/plots/${u}`)).data,d=i.form_data.find(p=>p.model==="plot_id");d&&(d.items=r)}catch(c){console.error("Failed to fetch plots:",c)}};return(u,c)=>{const r=t("v-text-field"),d=t("v-textarea"),p=t("v-radio"),k=t("v-radio-group"),U=t("v-select"),x=t("v-col"),g=t("v-row");return a(),o(g,null,{default:s(()=>[(a(!0),v(_,null,b(m.form_data,e=>(a(),v(_,null,[e.display?(a(),o(x,{key:0,cols:"12",md:"6"},{default:s(()=>[V("div",null,[e.type=="text"?(a(),o(r,{key:0,clearable:"",label:e.label,variant:"outlined",modelValue:e.value,"onUpdate:modelValue":l=>e.value=l,type:"text"},null,8,["label","modelValue","onUpdate:modelValue"])):n("",!0),e.type=="number"?(a(),o(r,{key:1,clearable:"",label:e.label,variant:"outlined",modelValue:e.value,"onUpdate:modelValue":l=>e.value=l,type:"number"},null,8,["label","modelValue","onUpdate:modelValue"])):n("",!0),e.type=="date"?(a(),o(r,{key:2,clearable:"",label:e.label,variant:"outlined",modelValue:e.value,"onUpdate:modelValue":l=>e.value=l,type:"date"},null,8,["label","modelValue","onUpdate:modelValue"])):n("",!0),e.type=="long_text"?(a(),o(d,{key:3,clearable:"",label:e.label,variant:"outlined",modelValue:e.value,"onUpdate:modelValue":l=>e.value=l},null,8,["label","modelValue","onUpdate:modelValue"])):n("",!0),e.type=="radio"?(a(),o(k,{key:4,modelValue:e.value,"onUpdate:modelValue":l=>e.value=l,inline:"",color:"success"},{label:s(()=>[V("div",null,j(e.label),1)]),default:s(()=>[(a(!0),v(_,null,b(e.items,(l,h)=>(a(),o(p,{key:h,label:l,value:l},null,8,["label","value"]))),128))]),_:2},1032,["modelValue","onUpdate:modelValue"])):n("",!0),e.type=="select"?(a(),o(U,{key:5,clearable:"",chips:"",label:e.label,items:e.items,variant:"outlined","item-title":"label","item-value":"value",modelValue:e.value,"onUpdate:modelValue":[l=>e.value=l,l=>y(e)],multiple:e.multiple,"return-object":!1},null,8,["label","items","modelValue","onUpdate:modelValue","multiple"])):n("",!0)])]),_:2},1024)):n("",!0)],64))),256))]),_:1})}}};export{F as _};
