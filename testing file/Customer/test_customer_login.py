from selenium import webdriver
from selenium.webdriver.common.by import By
import time

driver = webdriver.Chrome()

try:
    print("Executing Feature 2: Login Test")
    driver.get("http://localhost/Bakery_Hub_new/common/View/login.php")
    driver.maximize_window()
    time.sleep(2)

    
    driver.find_element(By.ID, "email").send_keys("test@gmail.com")
    driver.find_element(By.ID, "password").send_keys("123456")
    
    time.sleep(1)
    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    
    print("Login submitted successfully. Dashboard reached.")
    time.sleep(2)

except Exception as e:
    print(f"Script failed: {e}")
finally:
    driver.quit()