export default defineNuxtRouteMiddleware(() => {
  const user = useState("authUser");

  if (!user.value) {
    return navigateTo("/auth/signin");
  }

  if (user.value.role !== "admin") {
    return navigateTo("/books");
  }
});
