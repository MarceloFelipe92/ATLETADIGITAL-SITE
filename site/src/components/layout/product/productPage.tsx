"use client";

import { useSearchParams } from "next/navigation";
import ProductList from "@/components/layout/product/product-list";
import { IProduct } from "@/interfaces/IProduct";

interface ProductPageProps {
    products: IProduct[];
}

export default function ProductPage({ products }: ProductPageProps) {
    const searchParams = useSearchParams();
    const searchTerm = searchParams.get("search") || "";

    const filteredProducts = products.filter((product) =>
        product.produto.toLowerCase().includes(searchTerm.toLowerCase())
    );

    return (
        <div className="w-full max-w-screen-xl mx-auto px-4">
            <h2 className="text-2xl font-bold mb-4">
                {searchTerm
                    ? `Buscando por: "${searchTerm}"`
                    : "Todos os Produtos"}
            </h2>

            {filteredProducts.length > 0 ? (
                <ProductList products={filteredProducts} />
            ) : (
                <p>Nenhum produto encontrado.</p>
            )}
        </div>
    );
}
