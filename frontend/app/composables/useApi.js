export const useApi = () => {
  const apiBase = useRuntimeConfig().public.apiBase;
  const token = useCookie("auth_token");

  const api = $fetch.create({
    baseURL: apiBase,

    headers: {
      Authorization: `Bearer ${token.value}`,
    },
  });

  return api;
};