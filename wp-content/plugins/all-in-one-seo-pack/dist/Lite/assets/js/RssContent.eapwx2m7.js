import{G as u}from"./constants.fxxegv78.js";import{a as k,u as v,e as f}from"./index.nsvc8vqf.js";import{C as A}from"./Caret.hnvbzqgq.js";import{C as R}from"./Card.n68aovsj.js";import{C as w}from"./HtmlTagsEditor.k0zlm7pg.js";import{C as x}from"./SettingsRow.1l1umqn0.js";import{S as L}from"./External.h5te4wqm.js";import"./translations.lf9cwm9a.js";import{_ as T}from"./_plugin-vue_export-helper.oebm7xum.js";import{_ as o,a as _}from"./default-i18n.hohxoesu.js";import{v as r,c as B,C as s,l as a,o as g,a as i,t as l,x as S,k as D,b as V}from"./runtime-dom.esm-bundler.h3clfjuw.js";import"./helpers.fdpg7vgg.js";import"./Tooltip.jx4casvt.js";import"./index.h076fivy.js";import"./Slide.dop8j51m.js";import"./Editor.k6y9ox0q.js";import"./isEqual.gulmggc8.js";import"./_baseIsEqual.hstd7xe6.js";import"./_getTag.h6v5trhq.js";import"./_baseClone.nbrz7zdx.js";import"./_arrayEach.n8ou32wp.js";import"./UnfilteredHtml.erapx69a.js";import"./Row.o0q8mn7y.js";const t="all-in-one-seo-pack",H={setup(){return{optionsStore:k(),rootStore:v(),GLOBAL_STRINGS:u,links:f}},components:{CoreAlert:A,CoreCard:R,CoreHtmlTagsEditor:w,CoreSettingsRow:x,SvgExternal:L},data(){return{strings:{tooltip:o("Automatically add content to your site's RSS feed.",t),description:o("This feature is used to automatically add content to your site's RSS feed. More specifically, it allows you to add links back to your blog and your blog posts so scrapers will automatically add these links too. This helps search engines identify you as the original source of the content.",t),learnMore:o("Learn more",t),rssFeedDisabled:_(o("Your RSS feed has been disabled. Disabling the global RSS feed is NOT recommended. This will prevent users from subscribing to your content and can hurt your SEO rankings. You can re-enable the global RSS feed in the %1$scrawl content settings%2$s.",t),'<a href="'+this.rootStore.aioseo.urls.aio.searchAppearance+'&aioseo-scroll=crawl-content-global-feed&aioseo-highlight=crawl-content-global-feed#/advanced">',"</a>"),rssContent:o("RSS Content Settings",t),openYourRssFeed:o("Open Your RSS Feed",t),rssBeforeContent:o("RSS Before Content",t),rssAfterContent:o("RSS After Content",t),beforeRssDescription:o("Add content before each post in your site feed.",t),afterRssDescription:o("Add content after each post in your site feed.",t),unfilteredHtmlError:_(o("Your user account role does not have access to edit this field. %1$s",t),f.getDocLink(u.learnMore,"unfilteredHtml",!0))}}}},M={class:"aioseo-rss-content"},N={class:"aioseo-settings-row aioseo-section-description"},G=["innerHTML"],O={class:"aioseo-description"},Y={class:"aioseo-description"};function E(F,c,U,e,n,I){const b=r("core-alert"),h=r("svg-external"),C=r("base-button"),p=r("core-settings-row"),m=r("core-html-tags-editor"),y=r("core-card");return g(),B("div",M,[s(y,{slug:"rssContent","header-text":n.strings.rssContent},{tooltip:a(()=>[i("div",null,l(n.strings.tooltip),1)]),default:a(()=>[i("div",N,[S(l(n.strings.description)+" ",1),i("span",{innerHTML:e.links.getDocLink(e.GLOBAL_STRINGS.learnMore,"rssContent",!0)},null,8,G),e.optionsStore.options.searchAppearance.advanced.crawlCleanup.enable&&!e.optionsStore.options.searchAppearance.advanced.crawlCleanup.feeds.global?(g(),D(b,{key:0,type:"red",innerHTML:n.strings.rssFeedDisabled},null,8,["innerHTML"])):V("",!0)]),s(p,{name:e.GLOBAL_STRINGS.preview},{content:a(()=>[s(C,{size:"medium",type:"blue",tag:"a",href:e.rootStore.aioseo.urls.feeds.global,target:"_blank",disabled:e.optionsStore.options.searchAppearance.advanced.crawlCleanup.enable&&!e.optionsStore.options.searchAppearance.advanced.crawlCleanup.feeds.global},{default:a(()=>[s(h),S(" "+l(n.strings.openYourRssFeed),1)]),_:1},8,["href","disabled"])]),_:1},8,["name"]),s(p,{name:n.strings.rssBeforeContent},{content:a(()=>[s(m,{checkUnfilteredHtml:"",modelValue:e.optionsStore.options.rssContent.before,"onUpdate:modelValue":c[0]||(c[0]=d=>e.optionsStore.options.rssContent.before=d),"minimum-line-numbers":5,"tags-context":"rss","default-tags":["post_link","site_link","author_link"],disabled:e.optionsStore.options.searchAppearance.advanced.crawlCleanup.enable&&!e.optionsStore.options.searchAppearance.advanced.crawlCleanup.feeds.global},null,8,["modelValue","disabled"]),i("div",O,l(n.strings.beforeRssDescription),1)]),_:1},8,["name"]),s(p,{name:n.strings.rssAfterContent},{content:a(()=>[s(m,{checkUnfilteredHtml:"",modelValue:e.optionsStore.options.rssContent.after,"onUpdate:modelValue":c[1]||(c[1]=d=>e.optionsStore.options.rssContent.after=d),"minimum-line-numbers":5,"tags-context":"rss","default-tags":["post_link","site_link","author_link"],disabled:e.optionsStore.options.searchAppearance.advanced.crawlCleanup.enable&&!e.optionsStore.options.searchAppearance.advanced.crawlCleanup.feeds.global},null,8,["modelValue","disabled"]),i("div",Y,l(n.strings.afterRssDescription),1)]),_:1},8,["name"])]),_:1},8,["header-text"])])}const me=T(H,[["render",E]]);export{me as default};