import HTTP from "../utils/HTTP";

export const report = request => {
  const url = "/search/report";
  const options = {
    method: "POST",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  };

  return HTTP(url, {}, options);
};
