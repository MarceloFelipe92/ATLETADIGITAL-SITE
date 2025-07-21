import { IProduct } from "@/interfaces/IProduct";
import ProductItem from "./product-item";

interface ProductListProps {
  products: IProduct[];
}

const ProductList = ({ products }: ProductListProps) => {
  return (
    <div
      className="
        grid
        grid-cols-1
        sm:grid-cols-2
        md:grid-cols-2
        lg:grid-cols-3
        gap-10
        w-full
        mb-20
      "
    >
      {products.map((product) => (
        <ProductItem key={product.id_produto} product={product} />
      ))}
    </div>
  );
};

export default ProductList;
