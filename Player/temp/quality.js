(function(c){var h={extend:function(a,b){for(var d in b)b.hasOwnProperty(d)&&(a[d]="object"==typeof b[d]&&null!==b[d]?h.extend(a[d]||{},b[d]):b[d]);return a},res_label:function(a){return/^\d+$/.test(a)?a+"p":a}};c.ResolutionMenuItem=c.MenuItem.extend({init:function(a,b){b.label=h.res_label(b.res);b.selected=b.res.toString()===a.getCurrentRes().toString();c.MenuItem.call(this,a,b);this.resolution=b.res;this.on("click",this.onClick);a.on("changeRes",c.bind(this,function(){this.resolution==a.getCurrentRes()?
this.selected(!0):this.selected(!1)}))}});c.ResolutionMenuItem.prototype.onClick=function(){var a=this.player(),b=a.el().firstChild,d=a.currentTime(),e=a.paused(),f=a.controlBar.resolutionSelector.el().firstChild.children,c=f.length;if(a.getCurrentRes()!=this.resolution){"none"==b.preload&&(b.preload="metadata");a.src(a.availableRes[this.resolution]).one("loadedmetadata",function(){a.currentTime(d);e||a.play()});for(a.currentRes=this.resolution;0<c;)if(c--,"vjs-current-res"==f[c].className){f[c].innerHTML=
h.res_label(this.resolution);break}a.trigger("changeRes")}};c.ResolutionTitleMenuItem=c.MenuItem.extend({init:function(a,b){c.MenuItem.call(this,a,b);this.off("click")}});c.ResolutionSelector=c.MenuButton.extend({init:function(a,b){a.availableRes=b.available_res;c.MenuButton.call(this,a,b)}});c.ResolutionSelector.prototype.createItems=function(){var a=this.player(),b=[],d;b.push(new c.ResolutionTitleMenuItem(a,{el:c.Component.prototype.createEl("li",{className:"vjs-menu-title vjs-res-menu-title",
innerHTML:""})}));for(d in a.availableRes)"length"!=d&&b.push(new c.ResolutionMenuItem(a,{res:d}));b.sort(function(a,b){return"undefined"==typeof a.resolution?-1:parseInt(b.resolution)-parseInt(a.resolution)});return b};c.plugin("resolutionSelector",function(a){if(this.el().firstChild.canPlayType){var b=this,d=b.options().sources,e=d.length;a=h.extend({default_res:"",force_types:!1},a||{});for(var f={length:0},g,k=a.default_res&&"string"==typeof a.default_res?a.default_res.split(","):[];0<e;)e--,
d[e]["data-res"]&&(g=d[e]["data-res"],"object"!==typeof f[g]&&(f[g]=[],f.length++),f[g].push(d[e]));if(a.force_types)for(g in f)if("length"!=g)for(e=a.force_types.length;0<e;){e--;d=f[g].length;for(found_types=0;0<d;)d--,a.force_types[e]===f[g][d].type&&found_types++;if(found_types<a.force_types.length){delete f[g];f.length--;break}}if(!(2>f.length)){for(e=0;e<k.length;e++)if(f[k[e]]){b.src(f[k[e]]);b.currentRes=k[e];break}b.getCurrentRes=function(){if("undefined"!==typeof b.currentRes)return b.currentRes;
try{return res=b.options().sources[0]["data-res"]}catch(a){return""}};(g=b.getCurrentRes())&&(g=h.res_label(g));e=new c.ResolutionSelector(b,{el:c.Component.prototype.createEl(null,{className:"vjs-res-button vjs-menu-button vjs-control",innerHTML:'<div class="vjs-control-content"><span class="vjs-current-res">'+g+"</span></div>",role:"button","aria-live":"polite",tabIndex:0}),available_res:f});b.controlBar.resolutionSelector=b.controlBar.addChild(e)}}})})(videojs);