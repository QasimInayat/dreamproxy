const Home = () => import('./pages/Home');
console.log(Home);

export const routes = [{
    name: 'home',
    path: '/',
    component: Home,
    // meta: {
    //     title: 'Number 1 Voted Book Writing Agency Online | Diversity Writers',
    //     desc: 'Do you have a book idea itching to be a manuscript? Or are you looking for help to edit and format your book? {{brandWebsite}} is a team of talented professionals with a flair for everything literature. We help you with the concept, structure, as well as the narrative of your book and get you published without fail.'
    // }
}, ]
