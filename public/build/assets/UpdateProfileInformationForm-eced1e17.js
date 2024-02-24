import{T as q,r as _,o as h,c as P,w as n,h as i,f as x,a as t,b as s,e as g,G as y,E as B,j as b,g as k,u as o,l as j,$ as E,n as A,W as F}from"./app-d02c39e6.js";import{_ as D}from"./ActionMessage-7fd7b36d.js";import{_ as M}from"./FormSection-787a2ffe.js";import{a as d,_ as p}from"./TextInput-383772e5.js";import{_ as u}from"./InputLabel-ddcb72b1.js";import{_ as O}from"./PrimaryButton-673e91a3.js";import{_ as S}from"./SecondaryButton-df4cc9a3.js";import"./SectionTitle-bd9501d1.js";import"./_plugin-vue_export-helper-c27b6911.js";const R={key:0,class:"col-span-6 sm:col-span-4"},T={class:"mt-2"},z=["src","alt"],G={class:"mt-2"},L={class:"col-span-6 sm:col-span-4"},W={class:"col-span-6 sm:col-span-4"},Y={key:0},H={class:"text-sm mt-2"},J={class:"mt-2 font-medium text-sm text-green-600"},K={class:"col-span-6 sm:col-span-4"},Q={class:"col-span-6 sm:col-span-4"},X={class:"col-span-6 sm:col-span-4"},Z={class:"col-span-6 sm:col-span-4"},ee={class:"col-span-6 sm:col-span-4"},se=t("option",null,"Male",-1),oe=t("option",null,"Female",-1),le=[se,oe],pe={__name:"UpdateProfileInformationForm",props:{user:Object},setup(f){const m=f,e=q({_method:"PUT",name:m.user.name,email:m.user.email,phone:m.user.phone,address:m.user.address,dob:m.user.dob,city:m.user.city,gender:m.user.gender,photo:null}),V=_(null),v=_(null),c=_(null),C=()=>{c.value&&(e.photo=c.value.files[0]),e.post(route("user-profile-information.update"),{errorBag:"updateProfileInformation",preserveScroll:!0,onSuccess:()=>w()})},U=()=>{V.value=!0},$=()=>{c.value.click()},I=()=>{const r=c.value.files[0];if(!r)return;const l=new FileReader;l.onload=a=>{v.value=a.target.result},l.readAsDataURL(r)},N=()=>{F.delete(route("current-user-photo.destroy"),{preserveScroll:!0,onSuccess:()=>{v.value=null,w()}})},w=()=>{var r;(r=c.value)!=null&&r.value&&(c.value.value=null)};return(r,l)=>(h(),P(M,{onSubmitted:C},{title:n(()=>[i(" Profile Information ")]),description:n(()=>[i(" Update your account's profile information and email address. ")]),form:n(()=>[r.$page.props.jetstream.managesProfilePhotos?(h(),x("div",R,[t("input",{ref_key:"photoInput",ref:c,type:"file",class:"hidden",onChange:I},null,544),s(u,{for:"photo",value:"Photo"}),g(t("div",T,[t("img",{src:f.user.profile_photo_url,alt:f.user.name,class:"rounded-full h-20 w-20 object-cover"},null,8,z)],512),[[y,!v.value]]),g(t("div",G,[t("span",{class:"block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center",style:B("background-image: url('"+v.value+"');")},null,4)],512),[[y,v.value]]),s(S,{class:"mt-2 mr-2",type:"button",onClick:b($,["prevent"])},{default:n(()=>[i(" Select A New Photo ")]),_:1},8,["onClick"]),f.user.profile_photo_path?(h(),P(S,{key:0,type:"button",class:"mt-2",onClick:b(N,["prevent"])},{default:n(()=>[i(" Remove Photo ")]),_:1},8,["onClick"])):k("",!0),s(d,{message:o(e).errors.photo,class:"mt-2"},null,8,["message"])])):k("",!0),t("div",L,[s(u,{for:"name",value:"Name"}),s(p,{id:"name",modelValue:o(e).name,"onUpdate:modelValue":l[0]||(l[0]=a=>o(e).name=a),type:"text",class:"mt-1 block w-full",required:"",autocomplete:"name"},null,8,["modelValue"]),s(d,{message:o(e).errors.name,class:"mt-2"},null,8,["message"])]),t("div",W,[s(u,{for:"email",value:"Email"}),s(p,{id:"email",modelValue:o(e).email,"onUpdate:modelValue":l[1]||(l[1]=a=>o(e).email=a),type:"email",class:"mt-1 block w-full",required:"",autocomplete:"username"},null,8,["modelValue"]),s(d,{message:o(e).errors.email,class:"mt-2"},null,8,["message"]),r.$page.props.jetstream.hasEmailVerification&&f.user.email_verified_at===null?(h(),x("div",Y,[t("p",H,[i(" Your email address is unverified. "),s(o(j),{href:r.route("verification.send"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500",onClick:b(U,["prevent"])},{default:n(()=>[i(" Click here to re-send the verification email. ")]),_:1},8,["href","onClick"])]),g(t("div",J," A new verification link has been sent to your email address. ",512),[[y,V.value]])])):k("",!0)]),t("div",K,[s(u,{for:"phone",value:"Phone"}),s(p,{id:"phone",modelValue:o(e).phone,"onUpdate:modelValue":l[2]||(l[2]=a=>o(e).phone=a),type:"text",class:"mt-1 block w-full",required:"",autocomplete:"phone"},null,8,["modelValue"]),s(d,{message:o(e).errors.phone,class:"mt-2"},null,8,["message"])]),t("div",Q,[s(u,{for:"address",value:"Address"}),s(p,{id:"address",modelValue:o(e).address,"onUpdate:modelValue":l[3]||(l[3]=a=>o(e).address=a),type:"text",class:"mt-1 block w-full",required:"",autocomplete:"address"},null,8,["modelValue"]),s(d,{message:o(e).errors.address,class:"mt-2"},null,8,["message"])]),t("div",X,[s(u,{for:"city",value:"City"}),s(p,{id:"city",modelValue:o(e).city,"onUpdate:modelValue":l[4]||(l[4]=a=>o(e).city=a),type:"text",class:"mt-1 block w-full",required:"",autocomplete:"city"},null,8,["modelValue"]),s(d,{message:o(e).errors.city,class:"mt-2"},null,8,["message"])]),t("div",Z,[s(u,{for:"dob",value:"Date Of Birth"}),s(p,{id:"dob",modelValue:o(e).dob,"onUpdate:modelValue":l[5]||(l[5]=a=>o(e).dob=a),type:"date",class:"mt-1 block w-full",required:"",autocomplete:"dob"},null,8,["modelValue"]),s(d,{message:o(e).errors.dob,class:"mt-2"},null,8,["message"])]),t("div",ee,[s(u,{for:"gender",value:"Gender"}),g(t("select",{class:"block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500",id:"grid-state","onUpdate:modelValue":l[6]||(l[6]=a=>o(e).gender=a)},le,512),[[E,o(e).gender]]),s(d,{message:o(e).errors.gender,class:"mt-2"},null,8,["message"])])]),actions:n(()=>[s(D,{on:o(e).recentlySuccessful,class:"mr-3"},{default:n(()=>[i(" Saved. ")]),_:1},8,["on"]),s(O,{class:A({"opacity-25":o(e).processing}),disabled:o(e).processing},{default:n(()=>[i(" Save ")]),_:1},8,["class","disabled"])]),_:1}))}};export{pe as default};