export default defineNuxtRouteMiddleware(async (from, to) => {
  const apiBase = useRuntimeConfig().public.apiBase;
  const token = useCookie("auth_token");

  if (!token.value) {
    return navigateTo("/auth/signin");
  }

  try {
    await $fetch(`${apiBase}/auth/me`, {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token.value}`,
      },
    });
  } catch (err) {
    token.value = null;
    return navigateTo("/auth/signin");
  }

  const user = useState("authUser");
  const response = await $fetch(`${apiBase}/auth/me`, {
    method: "POST",
    headers: {
      Authorization: `Bearer ${token.value}`,
    },
  });
  user.value = response;
});
