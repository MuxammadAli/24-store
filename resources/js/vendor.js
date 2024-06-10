import Vue from 'vue';

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

import Vue2Filters from 'vue2-filters'
import VueMask from 'v-mask'

import VueSocialSharing from 'vue-social-sharing'
import VueCookie from 'vue-cookie';
// import VueGoogleMap from 'vuejs-google-maps'


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


//Site
import ProductSlider from './components/Products/ProductSlider';
import ProductShow from './components/Products/ProductShow';

import Login from './components/Auth/Login';
import FavoritesBlock from './components/Favorites/FavoriteBlock';
import SearchBlock from './components/Search/SearchBlock';
import StocksBlock from './components/StocksBlock';
// import NewsSlider from './components/News/NewsSlider'
import NewsSection from './components/News/NewsSection'
//
import CategoriesBlock from "./components/CategoriesBlock";
import CartView from './components/Cart/CartView';
import CatalogShow from "./components/Catalog/CatalogView";
import CheckoutView from "./components/Checkout/CheckoutView";
import CartBasket from "./components/Cart/CartBasket";
import CartPreview from './components/Cart/CartPreview';

// import PartnerSlider from "./components/Partners/PartnerSlider";
import HeaderSlider from './components/Banners/HeaderSlider';
// import FeaturesSection from './components/FeaturesSection';
// import BonusSection from "./components/BonusSection";
// import StocksView from "./components/StocksView";
// import SpecialBlock from "./components/Specials/SpecialBlock";
// import BrandView from "./components/BrandView";

import ProfileAddress from './components/Profile/Address';
import CompilationView from "./components/CompilationView";
import CategoriesMobileBlock from "./components/CategoriesMobileBlock";
import PartnerSlider from "./components/PartnerSlider";
import RegionModal from "./components/RegionModal";
import CoinProduct from "./components/CoinProduct/CoinProduct";
import ExchangeConfirmModal from "./components/CoinProduct/ExchangeConfirmModal";

// Vue.component('news-slider', NewsSlider);
Vue.component('news-section', NewsSection);
//
Vue.component('products-slider', ProductSlider);
Vue.component('partner-slider', PartnerSlider);
Vue.component('product-show', ProductShow);
Vue.component('search-block', SearchBlock);
Vue.component('stocks-block', StocksBlock);
Vue.component('categories-block', CategoriesBlock);
Vue.component('categories-mobile-block', CategoriesMobileBlock);
//
Vue.component('login', Login);
Vue.component('profile-address', ProfileAddress);
Vue.component('favorite-block', FavoritesBlock);
Vue.component('cart-view', CartView);
Vue.component('checkout-view', CheckoutView);
Vue.component('catalog-show', CatalogShow);
Vue.component('compilation-view', CompilationView);
Vue.component('cart-basket', CartBasket);
Vue.component('cart-preview', CartPreview);
Vue.component('region-modal', RegionModal);

// Vue.component('partners-slider', PartnerSlider);
Vue.component('header-slider', HeaderSlider);
// Vue.component('features-section', FeaturesSection);
// Vue.component('bonus-section', BonusSection);
//
// Vue.component('stocks-view', StocksView);
// Vue.component('brand-view', BrandView);
//
// Vue.component('special-block', SpecialBlock);
Vue.component('coin-product-show', CoinProduct)
Vue.component('coin-product-confirm', ExchangeConfirmModal)





Vue.use(VueMask);
Vue.use(VueSocialSharing);

Vue.use(VueCookie);

Vue.use(VueInternationalization);
Vue.use(Vue2Filters);

// Vue.use(VueGoogleMap, {
//     load: {
//         apiKey: 'AIzaSyADAx5AI4o5BsTiheWgo0_aFIf6UcuCzsM',
//         // libraries: ['...']
//     }
// })

// Vue.prototype.$eventHub = new Vue();
// Vue.prototype.$event = new Vue();
// Vue.prototype.$eventBus = new Vue();
// Vue.config.productionTip = false;

Vue.config.productionTip = false
// export const bus = new Vue();

Vue.prototype.$eventBus = new Vue(); // Global event bus
// Vue.prototype.$eventCart = new Vue(); // Global event bus

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

const app = new Vue({
    el: '#app',
    i18n,
});
