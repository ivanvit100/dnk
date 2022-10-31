import Vue from 'vue'
import Router from 'vue-router'
import courseId from '../components/courseId'
import home from '../components/home'
import courses from '../components/courses'
import contacts from '../components/contacts'
import cabinet from '../components/cabinet'

Vue.use(Router)

export default new Router({
	mode: 'history',
	routes: [
    {
    	path: '/',
    	name: 'home',
    	component: home,
    	props: true
    },
    {
    	path: '/courses',
    	name: 'courses',
    	component: courses,
    	props: true
    },
    {
    	path: '/contacts',
    	name: 'contacts',
    	component: contacts,
    	props: true
    },
    {
    	path: '/course/:courseId',
    	name: 'course',
    	component: courseId,
    	props: true
    },
    {
        path: '/cabinet',
        name: 'cabinet',
        component: cabinet
    },
    {
		path: '*',
		redirect: '/',
	},
  ]
})
