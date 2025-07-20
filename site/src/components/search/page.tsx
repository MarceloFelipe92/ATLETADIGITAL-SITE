// src/app/product/page.tsx

import ProductPage from "@/components/layout/product/productPage";
import { fetchProducts } from "@/services/product/get";

export default async function ProductPageWrapper() {
    const products = await fetchProducts();
    return <ProductPage products={products} />;
}
