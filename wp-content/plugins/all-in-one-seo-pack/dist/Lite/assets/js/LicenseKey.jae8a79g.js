import{v as A,i as E,a as O,u as H,h as B,r as M,e as N}from"./index.nsvc8vqf.js";import{p as U}from"./popup.by9shv56.js";import{u as V}from"./Wizard.k83dkx8n.js";import{C as G}from"./Caret.hnvbzqgq.js";import{G as F,a as I}from"./Row.o0q8mn7y.js";import{S as D}from"./Checkmark.d5kkjaf5.js";import{W as R,a as Y,b as j}from"./Header.dy1nr3gs.js";import{W as q}from"./CloseAndExit.fogssdp0.js";import{_ as J}from"./Steps.mseeto7k.js";import"./translations.lf9cwm9a.js";import{_ as Q}from"./_plugin-vue_export-helper.oebm7xum.js";import{a as l,_ as t}from"./default-i18n.hohxoesu.js";import{v as s,c as _,C as n,l as a,o as d,a as c,x as u,t as m,b as g,F as X,J as Z,k as S}from"./runtime-dom.esm-bundler.h3clfjuw.js";import"./helpers.fdpg7vgg.js";import"./params.k8e95b6q.js";import"./addons.foby19s7.js";import"./upperFirst.mzmrvvb6.js";import"./_stringToArray.mpukyt2g.js";import"./toString.g0kcp64r.js";import"./Logo.nueehhao.js";import"./Index.fywmukpg.js";const o="all-in-one-seo-pack",$={setup(){const{getSelectedUpsellFeatures:e,strings:i}=V({stage:"license-key"});return{composableStrings:i,connectStore:A(),getSelectedUpsellFeatures:e,licenseStore:E(),optionsStore:O(),rootStore:H(),setupWizardStore:B()}},components:{CoreAlert:G,GridColumn:F,GridRow:I,SvgCheckmark:D,WizardBody:R,WizardCloseAndExit:q,WizardContainer:Y,WizardHeader:j,WizardSteps:J},data(){return{error:null,loading:!1,localLicenseKey:null,strings:M(this.composableStrings,{enterYourLicenseKey:l(t("Enter your %1$s License Key",o),"AIOSEO"),boldText:l("<strong>%1$s %2$s</strong>","AIOSEO","Lite"),purchasedBoldText:l("<strong>%1$s %2$s</strong>","AIOSEO","Pro"),linkText:l(t("upgrade to %1$s",o),"Pro"),placeholder:t("Paste your license key here",o),connect:t("Connect",o)})}},watch:{localLicenseKey(e){this.setupWizardStore.licenseKey=e}},computed:{noLicenseNeeded(){return l(t("You're using %1$s - no license needed. Enjoy!",o)+" 🙂",this.strings.boldText)},link(){return l('<strong><a href="%1$s" target="_blank">%2$s</a></strong>',N.utmUrl("general-settings","license-box"),this.strings.linkText)},tooltipText(){return this.rootStore.isPro?t("To unlock the selected features, please enter your license key below.",o):l(t("To unlock the selected features, please %1$s and enter your license key below.",o),this.link)},alreadyPurchased(){return l(t("Already purchased? Simply enter your license key below to connect with %1$s!",o),this.strings.purchasedBoldText)}},methods:{processConnectOrActivate(){if(this.rootStore.isPro)return this.processActivateLicense();this.processGetConnectUrl()},processActivateLicense(){this.error=null,this.loading=!0,this.rootStore.loading=!0,this.licenseStore.activate(this.localLicenseKey).then(()=>{this.optionsStore.internalOptions.internal.license.expired=!1,this.setupWizardStore.saveWizard("license-key").then(()=>{this.$router.push(this.setupWizardStore.getNextLink)})}).catch(e=>{if(this.loading=!1,this.localLicenseKey=null,this.rootStore.loading=!1,!e||!e.response||!e.response.body||!e.response.body.error||!e.response.body.licenseData){this.error=t("An unknown error occurred, please try again later.",o);return}const i=e.response.body.licenseData;i.invalid?this.error=t("The license key provided is invalid. Please use a different key to continue receiving automatic updates.",o):i.disabled?this.error=t("The license key provided is disabled. Please use a different key to continue receiving automatic updates.",o):i.expired?this.error=this.licenseKeyExpired:i.activationsError?this.error=t("This license key has reached the maximum number of activations. Please deactivate it from another site or purchase a new license to continue receiving automatic updates.",o):(i.connectionError||i.requestError)&&(this.error=t("There was an error connecting to the licensing API. Please try again later.",o))})},processGetConnectUrl(){this.loading=!0,this.rootStore.loading=!0,this.connectStore.getConnectUrl({key:this.localLicenseKey,wizard:!0}).then(e=>{if(e.body.url){if(!e.body.popup)return this.loading=!1,this.rootStore.loading=!1,window.open(e.body.url);this.openPopup(e.body.url)}})},openPopup(e){U(e,"_self",600,630,!0,["file","token"],this.completedCallback,this.closedCallback)},completedCallback(e){return e.wizard=!0,this.connectStore.processConnect(e)},closedCallback(e){if(e)return window.location.reload();this.loading=!1,this.rootStore.loading=!1},skipStep(){this.setupWizardStore.saveWizard(),this.$router.push(this.setupWizardStore.getNextLink)}},mounted(){this.localLicenseKey=this.setupWizardStore.licenseKey}},ee={class:"aioseo-wizard-license-key"},te={class:"header"},oe=["innerHTML"],re={class:"license-cta-box"},se=["innerHTML"],ne=["innerHTML"],ie={class:"license-key"},ae=c("input",{type:"text",name:"username",autocomplete:"username",style:{display:"none"}},null,-1),le={class:"go-back"},ce=c("div",{class:"spacer"},null,-1);function de(e,i,ue,p,r,h){const b=s("wizard-header"),L=s("wizard-steps"),v=s("svg-checkmark"),w=s("grid-column"),z=s("grid-row"),x=s("base-input"),f=s("base-button"),C=s("core-alert"),k=s("router-link"),T=s("wizard-body"),W=s("wizard-close-and-exit"),P=s("wizard-container");return d(),_("div",ee,[n(b),n(P,null,{default:a(()=>[n(T,null,{footer:a(()=>[c("div",le,[n(k,{to:p.setupWizardStore.getPrevLink,class:"no-underline"},{default:a(()=>[u("←")]),_:1},8,["to"]),u("   "),n(k,{to:p.setupWizardStore.getPrevLink},{default:a(()=>[u(m(r.strings.goBack),1)]),_:1},8,["to"])]),ce,n(f,{type:"gray",onClick:h.skipStep},{default:a(()=>[u(m(r.strings.skipThisStep),1)]),_:1},8,["onClick"])]),default:a(()=>[n(L),c("div",te,m(r.strings.enterYourLicenseKey),1),p.rootStore.isPro?g("",!0):(d(),_("div",{key:0,class:"description",innerHTML:h.noLicenseNeeded},null,8,oe)),c("div",re,[c("div",{innerHTML:h.tooltipText},null,8,se),n(z,null,{default:a(()=>[(d(!0),_(X,null,Z(p.getSelectedUpsellFeatures,(y,K)=>(d(),S(w,{sm:"6",key:K},{default:a(()=>[n(v),u(" "+m(y.name),1)]),_:2},1024))),128))]),_:1})]),p.rootStore.isPro?g("",!0):(d(),_("div",{key:1,innerHTML:h.alreadyPurchased},null,8,ne)),c("form",ie,[ae,n(x,{type:"password",placeholder:r.strings.placeholder,"append-icon":r.localLicenseKey?"circle-check":null,autocomplete:"new-password",modelValue:r.localLicenseKey,"onUpdate:modelValue":i[0]||(i[0]=y=>r.localLicenseKey=y)},null,8,["placeholder","append-icon","modelValue"]),n(f,{type:"green",disabled:!r.localLicenseKey,loading:r.loading,onClick:h.processConnectOrActivate},{default:a(()=>[u(m(r.strings.connect),1)]),_:1},8,["disabled","loading","onClick"])]),r.error?(d(),S(C,{key:2,class:"license-key-error",type:"red",innerHTML:r.error},null,8,["innerHTML"])):g("",!0)]),_:1}),n(W)]),_:1})])}const Ee=Q($,[["render",de]]);export{Ee as default};