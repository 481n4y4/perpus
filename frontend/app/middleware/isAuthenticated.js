export default defineNuxtRouteMiddleware(async (from, to) => {
  const apiBase = useRuntimeConfig().public.apiBase;
  const token = useCookie("auth_token");
  const user = useState("authUser");

  if (!token.value) {
    return navigateTo("/auth/signin");
  }

  try {
    const response = await $fetch(`${apiBase}/auth/me`, {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token.value}`,
      },
    });

    user.value = response;
  } catch (err) {
    token.value = null;
    user.value = null;
    console.error(err);
    return navigateTo("/auth/signin");
  }
});
