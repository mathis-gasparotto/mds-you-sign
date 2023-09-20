const routes = [
  {
    path: "/welcome",
    component: () => import("layouts/WelcomeLayout.vue"),
    children: [
      {
        path: "login",
        name: "login",
        component: () => import("pages/LoginPage.vue")
      },
    ],
  },
  {
    path: "/no-navbar",
    component: () => import("layouts/NoNavbarLayout.vue"),
    children: [
      {
        path: 'lessons/:id/scan',
        name: 'signeScan',
        component: () => import('pages/SigneScanPage.vue')
      }
    ],
  },
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        name: "home",
        component: () => import("pages/IndexPage.vue")
      },
      {
        path: "account",
        name: "account",
        component: () => import("pages/AccountPage.vue")
      },
      {
        path: "lessons/:id",
        name: "singleLesson",
        component: () => import("pages/SingleLessonPage.vue")
      }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
]

export default routes
