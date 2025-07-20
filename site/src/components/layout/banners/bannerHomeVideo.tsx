import styles from '@/components/layout/banners/bannerVideo.module.css';

const BannerVideo = () => {
    return (
        <section className="w-full video">
            <div className="relative w-full">
                <div className="relative w-full" style={{ height: "700px" }}>
                    <div className={styles.videoWrapper}>
                        <video
                            className="h-[700px] w-full object-cover"
                            autoPlay
                            loop
                            muted
                        >
                            <source src="/videos/bannerprincipal.mp4" type="video/mp4" />
                            Seu navegador não suporta o elemento de vídeo.
                        </video>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default BannerVideo;
