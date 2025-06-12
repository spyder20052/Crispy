'use client'

import React, { useState, useEffect } from 'react'
import Image from 'next/image'
import styled from 'styled-components'

const StyledButton = styled.button`
  padding: 12.5px 30px;
  border: 0;
  border-radius: 100px;
  background-color: #FDB833;
  color: #ffffff;
  font-weight: Bold;
  transition: all 0.5s;
  -webkit-transition: all 0.5s;

  &:hover {
    background-color: #FDB833;
    box-shadow: 0 0 20px #6fc5ff50;
    transform: scale(1.1);
  }

  &:active {
    background-color: #FDB833;
    transition: all 0.25s;
    -webkit-transition: all 0.25s;
    box-shadow: none;
    transform: scale(0.98);
  }
`

export default function Home() {
  const [current, setCurrent] = useState(0)

  const slides = [
    {
      image: "/assets/burger1.png",
      bg: "/assets/Rectangle 43.png",
      color: "#FDB833",
      alt: "Burger",
      width: 1000,
      height: 1000,
    },
    {
      image: "/assets/frites 1.png",
      bg: "/assets/Rectangle 43.png",
      color: "#FDB833",
      alt: "Frites",
      width: 1000,
      height: 1000,
    },
    {
      image: "/assets/pizza 1.png",
      bg: "/assets/Rectangle 43.png",
      color: "#FF6B1A",
      alt: "Pizza",
      width: 800,
      height: 800,
    },
    {
      image: "/assets/chawarma 1.png",
      bg: "/assets/Rectangle 43.png",
      color: "#A08B5B",
      alt: "Shawarma",
      width: 1000,
      height: 1000,
    },
    {
      image: "/assets/smootie 1.png",
      bg: "/assets/Rectangle 43.png",
      color: "#F97C7C",
      alt: "Smoothie",
      width: 1200,
      height: 1200,
    },
    {
      image: "/assets/jus 1.png",
      bg: "/assets/Rectangle 43.png",
      color: "#7ED957",
      alt: "Jus",
      width: 800,
      height: 800,
    },
  ]

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrent((prev) => (prev + 1) % slides.length);
    }, 5000);
    return () => clearInterval(interval);
  }, [slides.length]);

  return (
    <main className="body" style={{ position: 'relative', minHeight: '100vh', background: '#d9d9d9' }}>
      {/* Bande décorative EN FOND */}
      <div style={{
        position: 'absolute',
        top: 0,
        left: 140,
        width: '100%',
        height: '100%',
        zIndex: 0,
        pointerEvents: 'none',
        overflow: 'hidden'
      }}>
        <Image
          src="/assets/bande1.png"
          alt="Bande décorative"
          width={1303}
          height={1080}
          style={{ objectFit: 'cover' }}
          priority
        />
        </div>

      {/* HEADER */}
      <header style={{ position: 'relative', width: '100%', height: '120px', background: 'transparent', zIndex: 10 }}>
        <div style={{
          position: 'relative',
          width: '100%',
          height: '120px',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          zIndex: 2
        }}>
          <div style={{
            position: 'relative',
            width: '100%',
            maxWidth: '1600px',
            margin: '0 auto',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'space-between',
            padding: '0 48px',
            height: '120px',
            zIndex: 2
          }}>
            <div style={{ display: 'flex', alignItems: 'center', minWidth: 160 }}>
              <Image
                className="logo"
                src="/assets/logo1.png"
                alt="Logo"
                width={135}
                height={60}
                priority
                style={{ width: 135, height: 60, objectFit: 'contain' }}
              />
            </div>
            <nav className="Menu" style={{
              display: 'flex',
              justifyContent: 'center',
              alignItems: 'center',
              gap: '64px',
              width: 'auto',
              background: 'transparent',
              fontFamily: "'Bellota', 'Poppins', Arial, sans-serif",
              fontSize: '18px',
              fontWeight: 400,
              color: '#222',
              zIndex: 2,
              paddingRight: 1000
            }}>
              <span className="accueil" style={{ fontWeight: 700, borderBottom: '4px solid #FDB833', paddingBottom: 2 }}>Accueil</span>
              <span className="menu" style={{ fontWeight: 400, opacity: 0.7 }}>Menu</span>
              <span className="apropos" style={{ fontWeight: 400, opacity: 0.7 }}>A propos</span>
              <span className="contact" style={{ fontWeight: 400, opacity: 0.7 }}>Contact</span>
            </nav>
            <div style={{ minWidth: 180, display: 'flex', justifyContent: 'flex-end', paddingRight: 1000 }}>
              <StyledButton>Commandez</StyledButton>
            </div>
          </div>
        </div>
      </header>
      <div className="bod">
        <div className="texte">
          <h6 className="welcome">
            Welcome To <br />
            Our Mr <span style={{ color: '#FF5800' }}>Crispy</span>
          </h6>
          <h2 className="lorem1">
            Lorem ipsum dolor sit amet consectetur. Mattis at bibendum velit nisl velit. Aliquet mauris elementum nisi aliquet. Facilisis ornare pulvinar tincidunt nec eu ultricies. Vulputate dolor et elementum accumsan. Volutpat nullam tempor condimentum id metus mi porttitor sem pretium. Purus mattis rhoncus quis sit elit.
            Tempor amet habitant pretium neque sit. Tellus posuere platea risus nibh et feugiat purus. Viverra nibh mi risus molestie id lobortis amet dignissim. Sit et feugiat nulla.
          </h2>
          <div className="com">
            <StyledButton>Commandez maintenant</StyledButton>
            <StyledButton style={{ backgroundColor: '#ffffff', color: '#000000', border: '1px solid #000000', marginLeft: '20px' }}>
              Prendre une table
            </StyledButton>
          </div>
        </div>
          <div
            className="rec"
            style={{
              position: 'relative',
              width: 1000,
              height: 800,
              top: 100,
              left: 1200,
              overflow: 'visible',
            }}
          >
            {/* Rectangle coloré dynamique */}
            <div
              style={{
                position: 'absolute',
                top: 0,
                left: 0,
                width: '1000px',
                height: '100%',
                zIndex: 1,
                background: slides[current].color,
                borderTopLeftRadius: 330,
                pointerEvents: 'none',
                userSelect: 'none',
                transition: 'background 0.4s'
              }}
            />
            {/* Image du produit dynamique */}
            <Image
              src={slides[current].image}
              alt={slides[current].alt}
              className="burger"
              width={slides[current].width}
              height={slides[current].height}
              style={{
                position: 'absolute',
                top: 40,
                left: -180,
                zIndex: 2,
                pointerEvents: 'auto',
              }}
              priority
            />
            {/* Navigation cercles */}
            <div
              style={{
                position: 'absolute',
                right: 120,
                top: '50%',
                transform: 'translateY(-50%)',
                display: 'flex',
                flexDirection: 'column',
                gap: 24,
                zIndex: 20,
                pointerEvents: 'auto',
              }}
            >
              {slides.map((_, idx) => (
                <button
                  key={idx}
                  onClick={() => setCurrent(idx)}
                  style={{
                    width: 18,
                    height: 18,
                    borderRadius: '50%',
                    border: 'none',
                    background: idx === current ? '#fff' : 'rgba(255,255,255,0.4)',
                    boxShadow: idx === current ? '0 0 0 2px #FDB833' : 'none',
                    cursor: 'pointer',
                    margin: 0,
                    padding: 0,
                    outline: 'none',
                    transition: 'all 0.2s',
                  }}
                  aria-label={`Voir ${slides[idx].alt}`}
                />
              ))}
            </div>
          </div>
          {/* <div className="bande2" style={{ position: 'relative', width: 1920, height: 311, top: 500, left: 0, zIndex: -2 }}>
          <Image
            src="/assets/assets 2.png"
            alt="Bande décorative"
            width={1920}
            height={311}
          />
          </div> */}
        </div>
      {/* <div className="menu-icons"> */}
        {/* <div className="menu-item">
          <Image src="/assets/burger1.png" alt="Burger" width={100} height={100} />
          <p>Burger</p>
        </div>
        <div className="menu-item">
          <Image src="/assets/frites 1.png" alt="Frites" width={100} height={100} />
          <p>Frites</p>
        </div>
        <div className="menu-item">
          <Image src="/assets/food 4.png" alt="Spaghetti" width={100} height={100} />
          <p>Spagetti</p>
        </div>
        <div className="menu-item">
          <Image src="/assets/food 5.png" alt="Sandwich" width={100} height={100} />
          <p>Sandwich</p>
        </div>
        <div className="menu-item">
          <Image src="/assets/food 6.png" alt="Boisson" width={100} height={100} />
          <p>Boisson</p>
        </div>
        <div className="menu-item">
          <Image src="/assets/food 7.png" alt="Combo" width={100} height={100} />
          <p>Combo</p>
        </div> */}
      {/* </div> */}

      {/* Bande décorative en bas */}
      <div
        className="bande2"
        style={{
          position: 'absolute',
          width: '100vw',
          height: 311,
          left: 0,
          bottom: -250,
          zIndex: 1,
          pointerEvents: 'none',
          overflow: 'hidden'
        }}
      >
        <Image
          src="/assets/assets 2.png"
          alt="Bande décorative bas"
          width={1920}
          height={311}
          style={{ objectFit: 'cover', width: '100vw', height: 311 }}
        />
      </div>
    </main>
  )
}
