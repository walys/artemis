
import { writable } from "svelte/store";

export const isLoading = writable(false);
export const error = writable(null);

async function request(method, endpoint, body = null) {
    isLoading.set(true);
    error.set(null);

    try {
        const headers = {
            Accept: "application/json",
            "Accept-Language": localStorage.getItem("lang") || "pt-BR",
            "X-Requested-With": "XMLHttpRequest",
        };

        // GET não precisa inicializar o CSRF.
        if (method !== "GET") {
            await fetch("/sanctum/csrf-cookie", {
                method: "GET",
                headers,
                credentials: "same-origin",
            });

            const xsrfCookie = document.cookie
                .split("; ")
                .find(cookie => cookie.startsWith("XSRF-TOKEN="));

            if (!xsrfCookie) {
                throw new Error("Cookie XSRF-TOKEN não encontrado.");
            }

            headers["X-XSRF-TOKEN"] = decodeURIComponent(
                xsrfCookie.substring("XSRF-TOKEN=".length)
            );
        }

        const options = {
            method,
            headers,
            credentials: "same-origin",
        };

        if (body !== null) {
            headers["Content-Type"] = "application/json";
            options.body = JSON.stringify(body);
        }

        const response = await fetch(endpoint, options);

        // Suporta respostas JSON e respostas sem conteúdo (204).
        const contentType = response.headers.get("content-type") || "";
        const data = contentType.includes("application/json")
            ? await response.json()
            : null;

        if (!response.ok) {
            throw data ?? {
                message: `Erro na requisição. Status: ${response.status}`,
            };
        }

        return data;

    } catch (err) {
        error.set(err);
        console.error(`Erro na requisição ${method}:`, err);
        throw err;

    } finally {
        isLoading.set(false);
    }
}

export const crud = {
    get(endpoint) {
        return request("GET", endpoint);
    },

    post(endpoint, formData) {
        return request("POST", endpoint, formData);
    },

    put(endpoint, formData) {
        return request("PUT", endpoint, formData);
    },

    delete(endpoint) {
        return request("DELETE", endpoint);
    },
};
