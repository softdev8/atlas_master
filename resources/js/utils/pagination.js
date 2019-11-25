export const skip = (items, c) => {
  return items.filter((x, i) => i > (c - 1))
};

export const limit = (items, c) => {
  return items.filter((x, i) => i <= (c - 1))
};