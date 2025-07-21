// src/components/layout/product/product-sidebar.tsx
"use client";

const ProductSidebar = () => {
  return (
    <aside
      className="
        w-full md:w-1/4 lg:w-1/5
        bg-gradient-to-br from-[#0c1f2e] via-[#142e46] to-[#0c1f2e]
        text-[#E0F2F7]
        p-8
        rounded-xl
        shadow-xl
        h-fit
        sticky
        top-24
        max-md:mb-8
        border border-[#1a3a50]/50
        mt-35
        transform
        transition-transform
        duration-300
        ease-in-out
        hover:scale-[1.02]
        hover:shadow-2xl
      "
    >
      <h2
        className="
          text-2xl font-extrabold mb-6
          text-transparent bg-clip-text bg-gradient-to-r from-[#39D5FF] via-[#B0D9E7] to-[#39D5FF]
          border-b border-[#39D5FF]/30
          pb-4 text-center tracking-wider
        "
      >
        Categorias
      </h2>

      <div className="mb-10">
        <h3 className="text-xl font-semibold mb-5 text-[#B0D9E7]">
          Categorias de Produtos
        </h3>
        <nav>
          <ul className="space-y-2">
            {[
              "Roupas Esportivas",
              "Acessórios de Natação",
              "Acessórios de Futebol",
              "Acessórios de Musculação",
              "Meta Verso",
            ].map((category, index) => (
              <li key={index}>
                <a
                  href={`#${category
                    .toLowerCase()
                    .replace(/\s+/g, "-")
                    .replace(/[^\w-]/g, "")}`}
                  className="
                    flex items-center justify-between
                    text-lg
                    text-[#E0F2F7]
                    py-2 px-4
                    rounded-md
                    hover:bg-[#1a3a50]/60
                    hover:text-[#39D5FF]
                    transition-all duration-300 ease-in-out
                    transform hover:translate-x-1
                    group
                  "
                >
                  <span>{category}</span>
                </a>
              </li>
            ))}
          </ul>
        </nav>
      </div>
    </aside>
  );
};

export default ProductSidebar;
