import {has, get} from "lodash";

// function for dynamic sorting

export const compareValues = (key, order = "asc") => {
  return (a, b) => {

    // check if property exists on either objects

    if (!has(a, key) || !has(b, key)) {
      return 0;
    }

    const A = get(a, key);
    const B = get(b, key);

    const X = (typeof A === "string") ?
      A.toLowerCase() : A;
    const Y = (typeof B === "string") ?
      B.toLowerCase() : B;

    let comparison = 0;

    if (X > Y) {
      comparison = 1;
    } else if (X < Y) {
      comparison = -1;
    }

    return order === "desc" ? (comparison * -1) : comparison;
  }
};

export const compareValuesExtended = (key, orderToSort, secondKey = "", order = "asc") => {
  return (a, b) => {

    // check if property exists on either objects

    if (!has(a, key) || !has(b, key)) {
      return 0;
    }

    const X = orderToSort.indexOf(get(a, key));
    const Y = orderToSort.indexOf(get(b, key));

    let comparison = 0;

    if (X > Y) {

      comparison = 1;

    } else if (X < Y) {

      comparison = -1;

    } else if (X === Y) {

      if (!has(a, secondKey) || !has(b, secondKey)) {
        return 0;
      }

      const A = get(a, secondKey);
      const B = get(b, secondKey);

      const X = (typeof A === "string") ?
        A.toLowerCase() : A;
      const Y = (typeof B === "string") ?
        B.toLowerCase() : B;

      let comparison = 0;

      if (X > Y) {
        comparison = 1;
      } else if (X < Y) {
        comparison = -1;
      }

      return order === "desc" ? (comparison * -1) : comparison;

    }

    return order === "desc" ? (comparison * -1) : comparison;
  }
};
