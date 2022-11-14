export default function auth({ next, router }) {
    if (!window.sessionStorage.getItem('token')) {
      return router.push({ name: 'login' });
    }
  
    return next();
  }